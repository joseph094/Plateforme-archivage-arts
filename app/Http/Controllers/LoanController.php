<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use App\Models\Artwork;
use App\Models\Exhibition;
use App\Models\Reservation;
use App\Models\Restoration;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Http\Controllers\Inventory_noticeController;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{

    public function index()
    {
        $loans = Loan::all();

        return view('loans.list', compact('loans'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $loans = Loan::where('user_id', $user_id)->get();
            } else {
                $loans = Loan::all();
            }
        } else {
            $loans = Loan::all();
        }
        return view('loans.list', compact('loans'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if (strpos($query, 'Institution :') !== false) {
            $search = str_replace('Institution :', '', $query);
        } else if (strpos($query, 'Exhibition Title :') !== false) {
            $search = str_replace('Exhibition Title :', '', $query);
        } else {
            $search = $query;
        }

        $loans = Loan::where('institution', 'like', "%$search%")->orWhere('exhibition_title', 'like', "%$search%")->get();

        return view('loans.list', compact('loans'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Loan::where('institution', 'LIKE', "%$query%")->orWhere('exhibition_title', 'LIKE', "%$query%")->get();
        $loans = array();
        foreach ($filterResult as $loan) {
            if (strpos($loan->institution, $query) !== false) {
                array_push($loans, "Institution :" . $loan->institution);
            } else if (strpos($loan->exhibition_title, $query) !== false) {
                array_push($loans, "Exhibition Title :" . $loan->exhibition_title);
            }
        }
        return response()->json($loans);
    }

    public function create()
    {
        return view('loans.create');
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
        $loan = new Loan();
        $loan->fill($request->all());
        $user_id = Auth::id();
        $loan->user_id = $user_id;
        $loan->save();
        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('loan');
    }


    public function show(Loan $loan)
    {
        return 2;
    }


    public function edit($id)
    {
        $loan = Loan::find($id);
        if (Auth::user()->id !== $loan->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan = $loan->fill($request->all());
        if ($loan->isClean()) {
            return redirect()->back()->withErrors(['error' => 'Atleast Something Has To Be Modified']);
        }

        $loan->save();


        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('loan');
    }


    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        if (Auth::user()->id !== $loan->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $loan->delete();
        return redirect('loan');


    }
}