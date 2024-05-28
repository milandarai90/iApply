<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminAddController extends Controller
{
    public function addConsultancy()
    {
        return view('superadmin.addConsultancy');
    }
    public function registerConsultancy(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'head_officeDistrict' => 'required',
            'head_officeMunicipaity' => 'required',
            'head_officeWard' => 'required',
            'tel_number' => 'required',
            'pan_number' => 'required',
            'head_person_idcard' => 'required|image|mimes:jpeg,jpg,png,gif,webp',
            'head_person_name' => 'required',
            'head_person_number' => 'required',
            'valid_documents' => 'required|image|mimes:jpeg,jpg,png,gif,webp',
            'password' => 'required|min:8|max:30',
            'c_password' => 'required|same:password',
        ]);
        $head_personID = time() . 'head_person_idcard' . $request->file('head_person_idcard')->getClientOriginalExtension();
        $id_path = $request->file('head_person_idcard')->storeAs('public/head_person_idcard/' . $head_personID);
        $id_newpath = str_replace('public/', '', $id_path);

        $valid_documents = time() . 'valid_documents' . $request->file('valid_documents')->getClientOriginalExtension();
        $valid_documents_path = $request->file('valid_documents')->storeAs('/public/valid_documents/' . $valid_documents);
        $valid_newpath = str_replace('/public', '', $valid_documents_path);
    }
}
