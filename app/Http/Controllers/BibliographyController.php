<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bibliography;
use App\Http\Controllers\Inventory_noticeController;
use Illuminate\Support\Facades\Auth;


class BibliographyController extends Controller
{

    public function index()
    {
        $bibliographies = Bibliography::all();

        return view('bibliographies.list', compact('bibliographies'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $bibliographies = Bibliography::where('user_id', $user_id)->get();
            } else {
                $bibliographies = Bibliography::all();
            }
        } else {
            $bibliographies = Bibliography::all();
        }
        return view('bibliographies.list', compact('bibliographies'));
    }
    public function search(Request $request)
    {
        $query = $request->get('query');

        if (strpos($query, 'Book Title :') !== false) {
            $search = str_replace('Book Title :', '', $query);
        } else if (strpos($query, 'Author Name :') !== false) {
            $search = str_replace('Author Name :', '', $query);
        } else if (strpos($query, 'Publisher :') !== false) {
            $search = str_replace('Publisher :', '', $query);
        } else {
            $search = $query;
        }

        $bibliographies = Bibliography::where('book_title', 'like', "%$search%")->orWhere('author_name', 'like', "%$search%")->orWhere('publisher', 'like', "%$search%")->get();

        return view('bibliographies.list', compact('bibliographies'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $bibliographys = array();
        $filterResult = Bibliography::where('book_title', 'LIKE', "%$query%")->orWhere('author_name', 'LIKE', "%$query%")->orWhere('publisher', 'LIKE', "%$query%")->get();
        foreach ($filterResult as $bibliography) {
            if (strpos($bibliography->book_title, $query) !== false) {
                array_push($bibliographys, "Book Title :" . $bibliography->book_title);
            } else if (strpos($bibliography->author_name, $query) !== false) {
                array_push($bibliographys, "Author Name :" . $bibliography->author_name);
            } else {
                array_push($bibliographys, "Publisher :" . $bibliography->publisher);
            }
        }
        return response()->json($bibliographys);
    }

    public function create()
    {
        return view('bibliographies.create');
    }

    public function store(Request $request)
    {
        $bibliography = new Bibliography();
        $bibliography->fill($request->all());
        $user_id = Auth::id();
        $bibliography->user_id = $user_id;
        $bibliography->save();

        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('bibliography');
    }


    public function show(Bibliography $bibliography)
    {
        return 2;
    }


    public function edit($id)
    {
        $bibliography = Bibliography::find($id);
        if (Auth::user()->id !== $bibliography->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        return view('bibliographies.edit', compact('bibliography'));
    }

    public function update(Request $request, $id)
    {
        $bibliography = Bibliography::findOrFail($id);
        $bibliography = $bibliography->fill($request->all());
        if ($bibliography->isClean()) {
            return redirect()->back()->withErrors(['error' => 'Atleast Something Has To Be Modified']);
        }

        $bibliography->save();

        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);

        return redirect('bibliography');
    }


    public function destroy($id)
    {
        $bibliography = Bibliography::findOrFail($id);
        if (Auth::user()->id !== $bibliography->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $bibliography->delete();
        return redirect('bibliography');


    }
}