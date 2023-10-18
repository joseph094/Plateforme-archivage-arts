<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Exhibition;
use App\Models\Image;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Http\Controllers\Inventory_noticeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArtworkController extends Controller
{

    public function index()
    {
        $artworks = Artwork::all();

        return view('artworks.list', compact('artworks'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('type');
        if ($query) {
            $artworks = Artwork::where('type', 'like', "%$query%")->get();
        } else {
            $artworks = Artwork::get();
        }
        return view('artworks.list', compact('artworks'));
    }

    public function filterc(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $artworks = Artwork::where('user_id', $user_id)->get();
            } else {
                $artworks = Artwork::all();
            }
        } else {
            $artworks = Artwork::all();
        }
        return view('artworks.list', compact('artworks'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if (strpos($query, 'Type :') !== false) {
            $search = str_replace('Type :', '', $query);
        } else if (strpos($query, 'Title :') !== false) {
            $search = str_replace('Title :', '', $query);
        } else if (strpos($query, 'Inventory Number :') !== false) {
            $search = str_replace('Inventory Number :', '', $query);
        } else {
            $search = $query;
        }

        $artworks = Artwork::where('title', 'like', "%$search%")->orWhere('inventory_number', 'like', "%$search%")->orWhere('type', 'LIKE', "%$search%")->get();

        return view('artworks.list', compact('artworks'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Artwork::where('title', 'LIKE', "%$query%")->orWhere('inventory_number', 'LIKE', "%$query%")->orWhere('type', 'LIKE', "%$query%")->get();
        $artworks = array();
        foreach ($filterResult as $artwork) {
            if (strpos($artwork->title, $query) !== false) {
                array_push($artworks, "Title :" . $artwork->title);
            } else if (strpos($artwork->inventory_number, $query) !== false) {
                array_push($artworks, "Inventory Number :" . $artwork->inventory_number);
            } else {
                array_push($artworks, "Type :" . $artwork->type);
            }
        }
        return response()->json($artworks);
    }

    public function create()
    {
        $availableMaterials = Material::all();
        $availableArtists = Artist::all();
        return view('artworks.create', compact('availableMaterials', 'availableArtists'));
    }

    public function store(Request $request)
    {
        if ($request->input('materials') === 'new_material') {
            // Insert the new material into the database
            $newMaterial = new Material;
            $newMaterial->name = $request->input('new_material_name');
            $newMaterial->save();

            // Get the ID of the new material
            $materialId = $newMaterial->id;
        } else {
            // Use the selected material ID from the form data
            $materialId = $request->input('materials');
        }
        $artwork = new Artwork();
        $artwork->fill($request->all());
        $user_id = Auth::id();
        $artwork->user_id = $user_id;
        $artwork->material_id = $materialId;
        $request->session()->put('artwork', $artwork);


        return view('artworks.artworkimage', compact('artwork'));
    }

    public function linktoimage(Request $request)
    {
        $artwork = $request->session()->get('artwork');
        $artwork->save();
        $image = new Image();
        $image->artwork_id = $artwork->id;
        $user_id = Auth::id();
        $image->user_id = $user_id;
        $image->copyright_notice = $request->input('copyright_notice');
        $image->photographic_rights = $request->input('photographic_rights');
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $image->path = $imageName;

        $image->save();

        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $artwork->id]);
        (new Inventory_noticeController)->store($request_notice);

        return redirect('artwork');
    }


    public function show($id)
    {
        $artwork = Artwork::findOrFail($id);
        $material = Material::findOrFail($artwork->material_id);
        $artist = Artist::findOrFail($artwork->artist_id);
        $exhibitions = $artwork->exhibition;
        $material_name = $material->name;
        $acquisition = $artwork->acquisition;
        $bibliography = $artwork->bibliography;
        $reservations = $artwork->reservation;
        $images = $artwork->images;
        $loans = $artwork->loan;
        $restorations = $artwork->restoration;
        $currentLocation = $this->getCurrentLocation($artwork);
        return view('artworks.details', compact('artwork', 'acquisition', 'bibliography', 'exhibitions', 'images', 'loans', 'restorations', 'reservations', 'material_name', 'currentLocation', 'artist'));
    }

    private function getCurrentLocation($artwork)
    {
        $acquisition = $artwork->acquisition;
        if ($acquisition) {
            return $acquisition;
        }

        $reservations = $artwork->reservation;
        if ($reservations->count() > 0) {
            return $reservations->first();
        }

        $restorations = $artwork->restoration;
        foreach ($restorations as $restoration) {
            if (!$restoration->end_date || $restoration->end_date > date('Y-m-d')) {
                return $restoration;
            }
        }

        $loans = $artwork->loan;
        foreach ($loans as $loan) {
            if ($loan->return_date > date('Y-m-d')) {
                return $loan;
            }
        }

        $exhibitions = $artwork->exhibition;
        foreach ($exhibitions as $exhibition) {
            if ($exhibition->end_date > date('Y-m-d') || !$exhibition->end_date) {
                return $exhibition;
            }
        }
        $current_conserved = $artwork;

        return $current_conserved;
    }


    public function edit($id)
    {
        $artwork = Artwork::find($id);
        if (Auth::user()->id !== $artwork->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $availableArtists = Artist::all();
        $availableMaterials = Material::all();

        return view('artworks.edit', compact('artwork', 'availableMaterials', 'availableArtists'));
    }

    public function update(Request $request, $id)
    {
        if ($request->input('materials') === 'new_material') {
            // Insert the new material into the database
            $newMaterial = new Material;
            $newMaterial->name = $request->input('new_material_name');
            $newMaterial->save();

            // Get the ID of the new material
            $materialId = $newMaterial->id;
        } else {
            // Use the selected material ID from the form data
            $materialId = $request->input('materials');
        }
        $artwork = Artwork::findOrFail($id);
        $artwork = $artwork->fill($request->all());
        $artwork->material_id = $materialId;
        if ($artwork->isClean()) {
            return redirect()->back()->withErrors(['error' => 'Atleast Something Has To Be Modified']);
        }

        $artwork->save();

        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $id]);
        (new Inventory_noticeController)->store($request_notice);

        return redirect('artwork');
    }


    public function destroy($id)
    {
        $artwork = Artwork::findOrFail($id);
        if (Auth::user()->id !== $artwork->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $artwork->images()->delete();
        $artwork->delete();
        return redirect('artwork');
    }

    public function stats()
    {
        $artworkCountByYear = Artwork::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as count'))
            ->groupBy('year')
            ->get();
        $topFiveYears = $artworkCountByYear->sortByDesc('count')->take(5);
        $artworkCountByType = Artwork::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->orderBy('count', 'desc')
            ->get();

        $topArtists = Artist::select('artists.id', 'artists.first_name', 'artists.last_name', DB::raw('count(*) as count'))
            ->join('artworks', 'artists.id', '=', 'artworks.artist_id')
            ->groupBy('artists.id', 'artists.first_name', 'artists.last_name')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $chartData = [];
        foreach ($topArtists as $artist) {
            $artistchartData[] = [
                'name' => $artist->first_name . ' ' . $artist->last_name,
                'y' => $artist->count
            ];
        }
        return view('artworks.statistics', compact('artworkCountByYear', 'artworkCountByType', 'topFiveYears', 'topArtists', 'artistchartData'));
    }
}