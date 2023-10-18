<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use App\Models\Loan;
use App\Models\Reservation;
use App\Models\Restoration;
use Illuminate\Http\Request;
use App\Models\Exhibition;
use App\Http\Controllers\Inventory_noticeController;
use Illuminate\Support\Facades\Auth;


class ExhibitionController extends Controller
{

    public function index()
    {
        $exhibitions = Exhibition::all();

        return view('exhibitions.list', compact('exhibitions'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $exhibitions = Exhibition::where('user_id', $user_id)->get();
            } else {
                $exhibitions = Exhibition::all();
            }
        } else {
            $exhibitions = Exhibition::all();
        }
        return view('exhibitions.list', compact('exhibitions'));
    }

    public function search(Request $request)
    {

        $query = $request->get('query');
        if (strpos($query, 'Specific Constraints :') !== false) {
            $search = str_replace('Specific Constraints :', '', $query);
        } else if (strpos($query, 'Exhibition Title :') !== false) {
            $search = str_replace('Exhibition Title :', '', $query);
        } else if (strpos($query, 'Exhibition Location :') !== false) {
            $search = str_replace('Exhibition Location :', '', $query);
        } else {
            $search = $query;
        }

        $exhibitions = Exhibition::where('specific_constraints', 'like', "%$search%")->orWhere('exhibition_title', 'like', "%$search%")->orWhere('exhibition_location', 'LIKE', "%$search%")->get();

        return view('exhibitions.list', compact('exhibitions'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Exhibition::where('specific_constraints', 'LIKE', "%$query%")->orWhere('exhibition_title', 'LIKE', "%$query%")->orWhere('exhibition_location', 'LIKE', "%$query%")->get();
        $exhibitions = array();
        foreach ($filterResult as $exhibition) {
            if (strpos($exhibition->specific_constraints, $query) !== false) {
                array_push($exhibitions, "Specific Constraints :" . $exhibition->specific_constraints);
            } else if (strpos($exhibition->exhibition_title, $query) !== false) {
                array_push($exhibitions, "Exhibition Title :" . $exhibition->exhibition_title);
            } else {
                array_push($exhibitions, "Exhibition Location :" . $exhibition->exhibition_location);
            }
        }
        return response()->json($exhibitions);
    }


    public function create()
    {
        return view('exhibitions.create');
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

        $existingAcquisition = Acquisition::where('artwork_id', $artwork_id)
            ->first();

        if ($existingAcquisition) {
            return redirect()->back()->withErrors(['error' => 'This Artwork Has Been Acquired']);
        }

        $existingReservation = Reservation::where('artwork_id', $artwork_id)
            ->first();

        if ($existingReservation) {
            return redirect()->back()->withErrors(['error' => 'This Artwork Is Reserved']);
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
        $exhibition = new Exhibition();
        $exhibition->fill($request->all());
        $user_id = Auth::id();
        $exhibition->user_id = $user_id;
        $exhibition->save();

        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('exhibition');
    }


    public function show(Exhibition $exhibition)
    {
        return 2;
    }


    public function edit($id)
    {
        $exhibition = Exhibition::find($id);
        if (Auth::user()->id !== $exhibition->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        return view('exhibitions.edit', compact('exhibition'));
    }

    public function update(Request $request, $id)
    {
        $exhibition = Exhibition::findOrFail($id);
        $exhibition = $exhibition->fill($request->all());
        if ($exhibition->isClean()) {
            return redirect()->back()->withErrors(['error' => 'Atleast Something Has To Be Modified']);
        }

        $exhibition->save();

        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('exhibition');
    }


    public function destroy($id)
    {
        $exhibition = Exhibition::findOrFail($id);
        if (Auth::user()->id !== $exhibition->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $exhibition->delete();
        return redirect('exhibition');


    }
}