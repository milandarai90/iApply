<?php

namespace App\Http\Controllers;

use App\Models\consultancy_branch;
use App\Models\consultancy_info;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperadminAddController extends Controller
{
    public function addConsultancy()
    {
        return view('superadmin.addConsultancy');
    }
    public function registerConsultancy(Request $request)
    {
        $request->validate([
            'consultancyName' => 'required',
            'email' => 'required|email|unique:users,email',
            'headOfficeDistrict' => 'required',
            'headOfficeMunicipality' => 'required',
            'headOfficeWard' => 'required',
            'phone' => 'required|min:10|max:10',
            'tel_number' => 'required | max:10',
            'pan_number' => 'required| min:4',
            'head_person_idcard' => 'required|image|mimes:jpeg,jpg,png,gif,webp',
            'head_person_name' => 'required',
            'head_person_number' => 'required|min:10|max:10',
            'valid_documents' => 'required|image|mimes:jpeg,jpg,png,gif,webp',
            'password' => 'required|min:8|max:30',
            'c_password' => 'required|same:password',
        ]);

        $image = 'head_person_idcard';
        $idcard_newpath = $request->file('head_person_idcard')->storeAs('consultancy_head_person_idcard', $image . '.jpg', 'public');

        $images = 'valid_documents';
        $valid_newpath = $request->file('valid_documents')->storeAs('consultancy_valid_documents', $images . '.jpg', 'public');

        $consultancy_info = new consultancy_info;
        $consultancy_info->telphone_num = $request->tel_number;
        $consultancy_info->pan_number = $request->pan_number;
        $consultancy_info->head_person_idcard = $idcard_newpath;
        $consultancy_info->head_person_fullname = $request->head_person_name;
        $consultancy_info->head_person_number = $request->head_person_number;
        $consultancy_info->valid_document = $valid_newpath;
        $saves = $consultancy_info->save();
        if ($saves) {
            $user = new User;
            $user->consultancy_id = $consultancy_info->id;
            $user->role = '2';
            $user->name = $request->consultancyName;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->u_district = $request->headOfficeDistrict;
            $user->u_municipality = $request->headOfficeMunicipality;
            $user->u_ward = $request->headOfficeWard;
            $user->password = hash::make($request->password);
            $user->save();
            $user->createToken($user->name . '.consultancy_token');
            return redirect()->route('superadmin.addConsultancy')->with('success', 'Consultancy registered successfully.');
        } else {
            $users = $consultancy_info->id;
            $users->delete();
            return redirect()->route('superadmin.addConsultancy')->with('fail', 'user registration failed.');
        }

    }

    public function addBranch()
    {
        $consultancy = consultancy_info::with('consultancyDetails')->get();
        return view('superadmin.addbranches', compact('consultancy'));
    }

    public function postBranch(Request $request)
    {
        $request->validate([
            'consultancyName' => 'required',
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

        $image = 'branchManagerIdcard';
        $newBranchManagerIdcardPath = $request->file('branchManagerIdcard')->storeAs('branchManagerIdcard', $image . '.jpg', 'public');

        $images = 'branchValidDocument';
        $newbranchValidDocumentPath = $request->file('branchValidDocument')->storeAs('branchValidDocument', $images . '.jpg', 'public');

        $branch = new consultancy_branch;
        $user = new User;
        $branch->consultancy_id = $request->consultancyName;
        $branch->branch_pan = $request->branchPan;
        $branch->branch_manager_name = $request->branchManager;
        $branch->branch_manager_phone = $request->branchManagerPhone;
        $branch->branch_manager_idcard = $newBranchManagerIdcardPath;
        $branch->branch_valid_document = $newbranchValidDocumentPath;
        $saved = $branch->save();
        if ($saved) {
            $user->name = $request->branchName;
            $user->phone = $request->branchPhone;
            $user->consultancy_id = $request->consultancyName;
            $user->branch_id = $branch->id;
            $user->role = '3';
            $user->email = $request->email;
            $user->password = hash::make($request->password);
            $user->u_district = $request->branchDistrict;
            $user->u_municipality = $request->branchMunicipality;
            $user->u_ward = $request->branchWard;
            $user->save();
            $user->createToken($user->name . '.branchToken');

        } else {
            $users = $user->id;
            $users->delete();
            return redirect()->route('superadmin.addBranch')->with('fail', 'Cannot add a branch');
        }
        return redirect()->route('superadmin.addBranch')->with('success', 'Branch registered successfullly.');
    }
}
