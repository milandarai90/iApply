<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\generalCountryGuidelines;

class generalCountryGuidelinesController extends Controller
{
    public function addGeneralCountryGuidelines(Request $request){
        $id = $request->id;
        return view('superadmin.addGeneralCountryGuidelines',compact('id'));
    }
    public function postGeneralCountryGuidelines(Request $request){
        $id = $request->id;
        $request->validate(
            [
                'guidelines'=>'required|min:5',
            ]
        );
        $guidelines = new generalCountryGuidelines;
        $guidelines->generalCountry_id = $id;
        $guidelines->guidelines = $request->guidelines;
        $save = $guidelines->save();
        if($save){
            return redirect()->back()->with('success','Guidelines is added successfully.');
        }else{
            return redirect()->back()->with('fail','Guidelines is not added.');
        }

    }
    public function viewGeneralCountryGuidelines(Request $request){
        $guidelines = generalCountryGuidelines::where('generalCountry_id',$request->id)
        ->with('generalCountryGuidelines_to_generalCountry')
        ->get()
        ->sortBy(function($query){
            $query->generalCountry_id;
        });
        return view('superadmin.viewGeneralCountryGuidelines',compact('guidelines'));
    }
}
