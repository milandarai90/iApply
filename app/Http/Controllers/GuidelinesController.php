<?php

namespace App\Http\Controllers;
use App\Models\country;
use App\Models\PersonalAccessToken;
use App\Models\country_guidelines;
use Auth;

use Illuminate\Http\Request;

class GuidelinesController extends Controller
{
    public function guidelines(){
        $country = country::where('consultancy_id',Auth::user()->consultancy_id)
        ->with('country_to_guidelines')
        ->get();
        return view('consultancy.guidelines',compact('country'));
    }
    public function guidelinesView(Request $request){
        $country = $request->country;
        $consultancy = $request->con_id;
        $user = $request->uid;
        $tokenCheck = PersonalAccessToken::where('token',$user)->first();
        if($tokenCheck){
            $user = $tokenCheck->user()->with('personalAccessTokens','consultancy')->first();
            $guidelines = country_guidelines::where('consultancy_id', $consultancy)
            ->where('country_id', $country)
            ->get();
            // $guidelines = country_guidelines::where('consultancy_id',$consultancy && 'country_id',$country)->get();
            $countryName = country::find($country);
     return view('consultancy.guidelinesView',compact('user','guidelines','country','countryName'));
        }
    }

    public function guidelinesAdd(Request $request){
        $country = $request->country;
        return view('consultancy.guidelinesAdd',compact('country'));
    }
    public function guidelinesPost(Request $request){
        $country = $request->country;
        $request->validate([
            'guidelines'=>'required'
        ]);
        $guidelines = new country_guidelines;
        $guidelines ->guidelines = $request->guidelines;
        $guidelines->consultancy_id = Auth::user()->consultancy_id;
        $guidelines->country_id = $country;
        $save = $guidelines->save();
        if($save){
            return redirect()->back()->with('success','Guidelines is added successfully.');
        }
        return redirect()->back()->with('fail','Guidelines is not added.');

    }
}
