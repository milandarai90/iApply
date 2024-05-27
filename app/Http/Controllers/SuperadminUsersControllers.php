<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminUsersControllers extends Controller
{
    public function users()
    {
        $userData = User::with([
            'allUsers' => function ($query) {
                $query->orderBy('id', 'asc');
            }
        ])->get();
        $data = compact('userData');
        return view('superadmin.allUsers')->with($data);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $findUser = User::find($id);
        // dd($findUser);
        $deleted = $findUser->delete();
        if ($deleted) {
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('fail', 'User is not deleted.');
        }
    }
}
