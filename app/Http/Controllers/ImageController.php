<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Controllers\Inventory_noticeController;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{

    public function index()
    {
        $images = Image::all();

        return view('images.list', compact('images'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('creator');
        if ($query) {
            if ($query == "Mine") {
                $user_id = Auth::id();
                $images = Image::where('user_id', $user_id)->get();
            } else {
                $images = Image::all();
            }
        } else {
            $images = Image::all();
        }
        return view('images.list', compact('images'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if (strpos($query, 'Copyright Notice :') !== false) {
            $search = str_replace('Copyright Notice :', '', $query);
        } else if (strpos($query, 'Photographic Rights :') !== false) {
            $search = str_replace('Photographic Rights :', '', $query);
        } else {
            $search = $query;
        }

        $images = Image::where('copyright_notice', 'like', "%$search%")->orWhere('photographic_rights', 'like', "%$search%")->get();

        return view('images.list', compact('images'));
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Image::where('copyright_notice', 'LIKE', "%$query%")->orWhere('photographic_rights', 'LIKE', "%$query%")->get();
        $images = array();
        foreach ($filterResult as $image) {
            if (strpos($image->copyright_notice, $query) !== false) {
                array_push($images, "Copyright Notice :" . $image->copyright_notice);
            } else if (strpos($image->photographic_rights, $query) !== false) {
                array_push($images, "Photographic Rights :" . $image->photographic_rights);
            }
        }
        return response()->json($images);
    }


    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $image = new Image();
        $user_id = Auth::id();
        $image->user_id = $user_id;
        $image->artwork_id = $request->input('artwork_id');
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
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('image');
    }


    public function show(Image $image)
    {
        return 2;
    }


    public function edit($id)
    {
        $image = Image::find($id);
        if (Auth::user()->id !== $image->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        return view('images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $image = Image::findOrFail($id);
        $image->artwork_id = $request->input('artwork_id');
        $image->copyright_notice = $request->input('copyright_notice');
        $image->photographic_rights = $request->input('photographic_rights');
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            $image->path = $imageName;
        }

        $image->save();


        $request_notice = new Request();
        $request_notice->replace(['artwork_id' => $request->input('artwork_id')]);
        (new Inventory_noticeController)->store($request_notice);
        return redirect('image');
    }


    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        if (Auth::user()->id !== $image->user_id && Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $image->delete();
        return redirect('image');


    }
}