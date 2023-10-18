<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();

        return view('materials.list', compact('materials'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $materials = Material::where('user_id', $user_id)->get();
            } else {
                $materials = Material::all();
            }
        } else {
            $materials = Material::all();
        }
        return view('materials.list', compact('materials'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if (strpos($query, 'Name :') !== false) {
            $query = str_replace('Name :', '', $query);
        }
        

        $materials = Material::where('name', 'like', "%$query%")->get();

        return view('materials.list', compact('materials'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Material::where('name', 'like', "%$query%")->get();
        $materials = array();
        foreach ($filterResult as $material) {
            if (strpos($material->name, $query) !== false) {
                array_push($materials, "Name :" . $material->name);
            }
        }
        return response()->json($materials);
    }



    public function create()
    {
        return view('materials.create');
    }

    public function storeForArtwork(Request $request)
    {
        $material = new Material();
        $material->fill($request->all());
        $material->save();
        return response()->json([
            'success' => true,
            'material' => [
                'id' => $material->id,
                'name' => $material->name
            ]
        ]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $material = new Material();
        $material->user_id=$user_id;
        $material->fill($request->all());
        $material->save();
        return redirect("material");
    }


    public function show($id)
    {
        $material = Material::findOrFail($id);
        return $material;
    }


    public function edit($id)
    {
        $material = Material::find($id);
        if (Auth::user()->id !== $material->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        $material = $material->fill($request->all());
        if ($material->isClean()) {
            return redirect()->back()->withErrors(['error' => 'Atleast Something Has To Be Modified']);
        }

        $material->save();
        return redirect('material');
    }


    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        if (Auth::user()->id !== $material->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $material->delete();
        return redirect('material');
    }
}
