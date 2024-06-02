<?php

namespace App\Http\Controllers;

use App\Models\consultancy_branch;
use App\Models\consultancy_info;
use App\Models\PersonalAccessToken;
use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminUsersControllers extends Controller
{
    public function users()
    {
        $userData = User::with('allUsers', 'personalAccessTokens', 'consultancy')->orderBy('role', 'asc')->get();
        $data = compact('userData');
        return view('superadmin.allUsers')->with($data);
    }

    public function delete(Request $request)
    {
        $token = $request->id;
        $tokenFind = PersonalAccessToken::where('token', $token)->first();
        if ($tokenFind) {
            $user = $tokenFind->user()->with('personalAccessTokens')->first();
            $user->delete();
            $tokenFind->delete();
            return redirect()->back()->with('success', 'Deleted successfully.');
        } else {
            return redirect()->back()->with('fail', 'Data is not deleted.');
        }
    }

    public function viewConsultancies()
    {
        $consultancies = User::where('role', '2')->with('consultancies', 'personalAccessTokens')->get()
            ->sortBy(function ($query) {
                $query->consultancies->name;
            });
        return view('superadmin.viewConsultancies', compact('consultancies'));
    }
    public function viewBranch()
    {
        // $viewBranch = user::where('role', '3')->with('userBranch')->get()->sortBy(function ($query) {
        //     $query->userBranch->name ?? '';
        // });
        // return view('superadmin.viewBranch', compact('viewBranch'));
        // $viewBranch = consultancy_branch::with('') 
    }

    public function viewDetailsofUser(Request $request)
    {
        $title = 'Details of';
        $token = $request->id;
        $findToken = PersonalAccessToken::where('token', $token)->first();
        if ($findToken) {
            $findTokenUser = $findToken->user()->with('personalAccessTokens', 'allUsers', 'consultancies', 'userBranch')->first();
            return view('superadmin.viewDetailsofUser', compact('findTokenUser', 'title'));
        }
        return redirect()->back()->with('fail', 'User not found.');
    }

}
