<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory_notice;

class Inventory_noticeController extends Controller
{

    public function index()
    {
        $inventory_notices = Inventory_notice::all();

        return view('inventory_notices.list', compact('inventory_notices'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if (strpos($query, 'Editor Name :') !== false) {
            $search = str_replace('Editor Name :', '', $query);
        } else if (strpos($query, 'Artwork ID :') !== false) {
            $search = str_replace('Artwork ID :', '', $query);
        } else {
            $search = $query;
        }

        $inventory_notices = Inventory_notice::where('editor_name', 'like', "%$search%")->orWhere('artwork_id', 'like', "%$search%");

        return view('inventory_notices.list', compact('inventory_notices'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Inventory_notice::where('editor_name', 'LIKE', "%$query%")->orWhere('artwork_id', 'LIKE', "%$query%")->get();
        $inventory_notices = array();
        foreach ($filterResult as $inventory_notice) {
            if (strpos($inventory_notice->editor_name, $query) !== false) {
                array_push($inventory_notices, "Editor Name :" . $inventory_notice->editor_name);
            } else {
                array_push($inventory_notices, "Artwork ID :" . $inventory_notice->artwork_id);
            }
        }
        return response()->json($inventory_notices);
    }


    public function store(Request $request)
    {
        $user = auth()->user();
        $inventory_notice = Inventory_notice::create([
            'artwork_id' => $request->input('artwork_id'),
            'editor_name' => $user->name,

        ]);
        $inventory_notice->save();

        return redirect('inventory_notice');
    }


    public function show(Inventory_notice $inventory_notice)
    {
        return 2;
    }

    public function destroy($id)
    {
        $inventory_notice = Inventory_notice::findOrFail($id);
        $inventory_notice->delete();
        return redirect('inventory_notice');


    }
}