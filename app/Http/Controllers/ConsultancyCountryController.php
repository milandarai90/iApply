<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\country;

class ConsultancyCountryController extends Controller
{
    public function addCountry(){
        return view('consultancy.addCountry');
    }

    public function postCountry(Request $request){
        $request->validate([
            'country'=>'required',
            'countryImage'=>'required|image|mimes:jpeg,jpg,png,gif,webp',
        ]);
        $image = time() . 'consultancy_country_logo.' .$request->file('countryImage')->getClientOriginalExtension();
        $paths = $request->file('countryImage')->storeAs('public/consultancy/Countrylogo/' .$image);
        $newpath = str_replace('public/' ,'',$paths);

        $country = new country;
        $country->name = $request->country;
        $country->consultancy_id = Auth::user()->consultancy_id;
        $country->country_map = $newpath;
        $saved = $country->save();
        if($saved){
            return redirect()->back()->with('success','Country has been added successfully.');
        }
        return redirect()->back()->with('fail','Country has not been added.');
    }
    
    public function viewCountry(){

        $viewCountry = country::where('consultancy_id', Auth::user()->consultancy_id)
        ->with('country_to_consultancy')
        ->get();
        return view('consultancy.viewCountry',compact('viewCountry'));
    }
}
