<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }

    public function makesuper($id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $user->role="superadmin";
        $user->save();
        return redirect('users');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->role != "superadmin") {
            return view('errors.error');
        }
        $user->delete();
        return redirect('users');
    }
}
