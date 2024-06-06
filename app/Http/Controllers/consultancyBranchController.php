<?php

namespace App\Http\Controllers;

use App\Models\PersonalAccessToken;
use App\Models\consultancy_branch;
use App\Models\consultancy_info;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class consultancyBranchController extends Controller
{
    public function addBranch()
    {
        $consultancy = consultancy_info::all();
        return view('consultancy.addBranch', compact('consultancy'));
    }

    public function postBranch(Request $request)
    {
        $request->validate([
            'branchName' => 'required',
            'branchPhone' => 'required|min:10|max:10',
            'email' => 'required|email|unique:users,email',
            'branchDistrict' => 'required',
            'branchMunicipality' => 'required',
            'branchWard' => 'required',
            'branchPan' => 'required|min:4',
            'branchManager' => 'required',
            'branchManagerPhone' => 'required|min:10|max:10',
            'branchManagerIdcard' => 'required|image|mimes:jpeg,jpg,png,gif,webp',
            'branchValidDocument' => 'required|image|mimes:jpeg,jpg,png,gif,webp',
            'password' => 'required|min:8|max:30',
            'c_password' => 'required|same:password',
        ]);

        $image = time() . 'branchManagerIdcard .' . $request->file('branchManagerIdcard')->getClientOriginalExtension();
        $path = $request->file('branchManagerIdcard')->storeAs('public/branchManagerIdcard/' . $image);
        $newBranchManagerIdcardPath = str_replace('public/', '', $path);

        $images = time() . 'branchValidDocument .' . $request->file('branchValidDocument')->getClientOriginalExtension();
        $paths = $request->file('branchValidDocument')->storeAs('public/branchValidDocument/' . $images);
        $newbranchValidDocumentPath = str_replace('public/', '', $paths);


        $branch = new consultancy_branch();
        $user = new User;
        $branch->consultancy_id = Auth::user()->consultancy->id;
        $branch->branch_pan = $request->branchPan;
        $branch->branch_manager_name = $request->branchManager;
        $branch->branch_manager_phone = $request->branchManagerPhone;
        $branch->branch_manager_idcard = $newBranchManagerIdcardPath;
        $branch->branch_valid_document = $newbranchValidDocumentPath;
        $saved = $branch->save();
        if ($saved) {
            $user->name = $request->branchName;
            $user->phone = $request->branchPhone;
            $user->consultancy_id = Auth::user()->consultancy->id;
            $user->branch_id = $branch->id;
            $user->role = '3';
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->u_district = $request->branchDistrict;
            $user->u_municipality = $request->branchMunicipality;
            $user->u_ward = $request->branchWard;
            $user->save();
            $user->createToken($user->name . '.branchToken');

        } else {
            // $users = $user->id;
            $branch->delete();
            return redirect()->route('consultancy.addBranch')->with('fail', 'Cannot add a branch');
        }
        return redirect()->route('consultancy.addBranch')->with('success', 'Branch registered successfullly.');
    }

    public function viewBranch()
    {
        $branch = consultancy_branch::where('consultancy_id', Auth::user()->consultancy_id)->with('userBranch', 'branch')->get();
        return view('consultancy.viewBranch', compact('branch'));
    }

    public function delete(Request $request)
    {
        $token = $request->id;
        $tokenUser = PersonalAccessToken::where('token', $token)->first();
        if ($tokenUser) {
            $user = $tokenUser->user()->with('personalAccessTokens', 'userBranch', 'consultancy')->first();
            if ($user->branch_id) {
                consultancy_branch::destroy($user->branch_id);
            }
            $tokenUser->delete();
            return redirect()->back()->with('success', 'Branch Deleted Successfully.');
        } else {
            return redirect()->back()->with('fail', 'Branch is not deleted.');
        }
    }


    public function viewDetails(Request $request)
    {
        $title = 'Details of ';
        $token = $request->id;
        $findToken = personalAccessToken::where('token', $token)->first();
        if ($findToken) {
            $user = $findToken->user()->with('personalAccessTokens', 'userBranch', 'consultancy', 'allUsers')->first();
            return view('consultancy.viewDetailsofUser', compact('user', 'title'));
        }
    }
}
