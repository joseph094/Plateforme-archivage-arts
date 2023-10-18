<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{

    public function index()
    {
        $artists = Artist::all();

        return view('artists.list', compact('artists'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if (strpos($query, 'Nationality :') !== false) {
            $search = str_replace('Nationality :', '', $query);
        } else if (strpos($query, 'First Name :') !== false) {
            $search = str_replace('First Name :', '', $query);
        } elseif (strpos($query, 'Last Name :') !== false) {
            $search = str_replace('Last Name :', '', $query);
        } else {
            $search = $query;
        }

        $artists = Artist::where('first_name', 'like', "%$search%")->orWhere('last_name', 'like', "%$search%")->orWhere('nationality', 'LIKE', "%$search%")->get();

        return view('artists.list', compact('artists'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $artists = Artist::where('user_id', $user_id)->get();
            } else {
                $artists = Artist::all();
            }
        } else {
            $artists = Artist::all();
        }
        return view('artists.list', compact('artists'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Artist::where('first_name', 'LIKE', "%$query%")->orWhere('last_name', 'LIKE', "%$query%")->orWhere('nationality', 'LIKE', "%$query%")->get();
        $artists = array();
        foreach ($filterResult as $artist) {
            if (strpos($artist->first_name, $query) !== false) {
                array_push($artists, "First Name :" . $artist->first_name);
            } else if (strpos($artist->last_name, $query) !== false) {
                array_push($artists, "Last Name :" . $artist->last_name);
            } else {
                array_push($artists, "Nationality :" . $artist->nationality);
            }
        }
        return response()->json($artists);
    }

    public function create()
    {
        $data = file_get_contents(public_path('country.json'));
        $countries = json_decode($data, true);
        return view('artists.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $artist = new Artist();
        $artist->fill($request->all());
        $user_id = Auth::id();
        $artist->user_id = $user_id;
        $artist->save();

        return redirect('artist');
    }


    public function show(Artist $artist)
    {
        return 2;
    }


    public function edit($id)
    {
        $artist = Artist::find($id);
        if (Auth::user()->id !== $artist->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $data = file_get_contents(public_path('country.json'));
        $countries = json_decode($data, true);

        return view('artists.edit', compact('artist', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);
        $artist = $artist->fill($request->all());
        if ($artist->isClean()) {
            return redirect()->back()->withErrors(['error' => 'Atleast Something Has To Be Modified']);
        }

        $artist->save();

        return redirect('artist');
    }


    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);
        if (Auth::user()->id !== $artist->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $artist->delete();
        return redirect('artist');


    }
}