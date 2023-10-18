<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use App\Models\Exhibition;
use App\Models\Loan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Restoration;
use App\Http\Controllers\Inventory_noticeController;
use Illuminate\Support\Facades\Auth;

class RestorationController extends Controller
{

    public function index()
    {
        $restorations = Restoration::all();

        return view('restorations.list', compact('restorations'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $restorations = Restoration::where('user_id', $user_id)->get();
            } else {
                $restorations = Restoration::all();
            }
        } else {
            $restorations = Restoration::all();
        }
        return view('restorations.list', compact('restorations'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if (strpos($query, 'Diagnosis :') !== false) {
            $search = str_replace('Diagnosis :', '', $query);
        } else if (strpos($query, 'Causes :') !== false) {
            $search = str_replace('Causes :', '', $query);
        } else if (strpos($query, 'Restoration Location :') !== false) {
            $search = str_replace('Restoration Location :', '', $query);
        } else if (strpos($query, 'Restorer Name :') !== false) {
            $search = str_replace('Restorer Name :', '', $query);
        } else if (strpos($query, 'Intervention Type :') !== false) {
            $search = str_replace('Intervention Type :', '', $query);
        } else {
            $search = $query;
        }
        $restorations = Restoration::where('diagnosis', 'like', "%$search%")->orWhere('causes', 'like', "%$search%")->orWhere('restoration_location', 'LIKE', "%$search%")->orWhere('restorer_name', 'LIKE', "%$search%")
            ->orWhere('intervention_type', 'LIKE', "%$search%")->get();

        return view('restorations.list', compact('restorations'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Restoration::where('diagnosis', 'like', "%$query%")->orWhere('causes', 'like', "%$query%")->orWhere('restoration_location', 'LIKE', "%$query%")->orWhere('restorer_name', 'LIKE', "%$query%")
            ->orWhere('intervention_type', 'LIKE', "%$query%")->get();
        $restorations = array();
        foreach ($filterResult as $restoration) {
            if (strpos($restoration->diagnosis, $query) !== false) {
                array_push($restorations, "Diagnosis :" . $restoration->diagnosis);
            } else if (strpos($restoration->causes, $query) !== false) {
                array_push($restorations, "Causes :" . $restoration->causes);
            } else if (strpos($restoration->restoration_location, $query) !== false) {
                array_push($restorations, "Restoration Location :" . $restoration->restoration_location);
            } else if (strpos($restoration->restorer_name, $query) !== false) {
                array_push($restorations, "Restorer Name :" . $restoration->restorer_name);
            } else {
                array_push($restorations, "Intervention Type :" . $restoration->intervention_type);
            }
        }
        return response()->json($restorations);
    }



    public function create()
    {
        return view('restorations.create');
    }

    public function store(Request $request)
    {
        $artwork_id = $request->artwork_id;
        $existingLoan = Loan::where('artwork_id', $request->artwork_id)
            ->where('return_date', '>', date('Y-m-d'))
            ->first();
        if ($existingLoan) {
            return redirect()->back()->withErrors(['error' => 'An existing loan for this artwork has not yet ended.']);
        }

        $existingReservation = Reservation::where('artwork_id', $artwork_id)
            ->first();

        if ($existingReservation) {
            return redirect()->back()->withErrors(['error' => 'This Artwork Is Reserved']);
        }

        $existingAcquisition = Acquisition::where('artwork_id', $artwork_id)
            ->first();

        if ($existingAcquisition) {
            return redirect()->back()->withErrors(['error' => 'This Artwork Has Been Acquired']);
        }

        $existingRestoration = Restoration::where('artwork_id', $artwork_id)
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>', date('Y-m-d'));
            })
            ->first();

        if ($existingRestoration) {
            return redirect()->back()->withErrors(['error' => 'This Artwork Is In Restoration']);
        }

        $existingExhibition = Exhibition::where('artwork_id', $artwork_id)
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>', date('Y-m-d'));
            })
            ->first();

        if ($existingExhibition) {
            return redirect()->back()->withErrors(['error' => 'This Artwork Is In Exhibition']);
        }
        $restoration = new Restoration();
        $restoration->fill($request->all());
        $user_id = Auth::id();
        $restoration->user_id = $user_id;
        $restoration->save();


        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('restoration');
    }


    public function show(Restoration $restoration)
    {
        return 2;
    }


    public function edit($id)
    {
        $restoration = Restoration::find($id);
        if (Auth::user()->id !== $restoration->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        return view('restorations.edit', compact('restoration'));
    }

    public function update(Request $request, $id)
    {
        $restoration = Restoration::findOrFail($id);
        $restoration = $restoration->fill($request->all());
        if ($restoration->isClean()) {
            return redirect()->back()->withErrors(['error' => 'Atleast Something Has To Be Modified']);
        }

        $restoration->save();


        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('restoration');
    }


    public function destroy($id)
    {
        $restoration = Restoration::findOrFail($id);
        if (Auth::user()->id !== $restoration->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $restoration->delete();
        return redirect('restoration');


    }
}