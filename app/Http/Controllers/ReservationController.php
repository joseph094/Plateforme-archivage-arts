<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use App\Models\Exhibition;
use App\Models\Loan;
use App\Models\Reservation;
use App\Models\Restoration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return view('reservations.list', compact('reservations'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $reservations = Reservation::where('user_id', $user_id)->get();
            } else {
                $reservations = Reservation::all();
            }
        } else {
            $reservations = Reservation::all();
        }
        return view('reservations.list', compact('reservations'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if (strpos($query, 'Place :') !== false) {
            $search = str_replace('Place :', '', $query);
        } else if (strpos($query, 'Storage Method :') !== false) {
            $search = str_replace('Storage MEthod :', '', $query);
        }else {
            $search=$query;
        }

        $reservations = Reservation::where('place', 'like', "%$search%")->orWhere('storage_method', 'like', "%$search%")->get();

        return view('reservations.list', compact('reservations'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Reservation::where('place', 'like', "%$query%")->orWhere('storage_method', 'like', "%$query%")->get();
        $reservations = array();
        foreach ($filterResult as $reservation) {
            if (strpos($reservation->place, $query) !== false) {
                array_push($reservations, "Place :" . $reservation->place);
            } else if (strpos($reservation->storage_method, $query) !== false) {
                array_push($reservations, "Storage Method :" . $reservation->storage_method);
            }
        }
        return response()->json($reservations);
    }



    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {$artwork_id = $request->artwork_id;
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

        $reservation = new Reservation();
        $user_id = Auth::id();
        $reservation->user_id=$user_id;
        $reservation->fill($request->all());
        $reservation->save();


        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('reservation');
    }


    public function show(Reservation $reservation)
    {
        return 2;
    }


    public function edit($id)
    {
        $reservation = Reservation::find($id);
        if (Auth::user()->id !== $reservation->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation = $reservation->fill($request->all());
        if ($reservation->isClean()) {
            return redirect()->back()->withErrors(['error' => 'Atleast Something Has To Be Modified']);
        }

        $reservation->save();


        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('reservation');
    }


    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (Auth::user()->id !== $reservation->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $reservation->delete();
        return redirect('reservation');
    }
}
