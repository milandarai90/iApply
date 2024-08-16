<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\generalCountry;
class GeneralCountryController extends Controller
{
    public function addGeneralCountry(){
        return view('superadmin.addGeneralCountry');
    }
    public function postGeneralCountry(Request $request){
        $request->validate([
            'country'=>'required',
            'countryImage'=>'required|image|mimes:jpeg,jpg,png,gif,webp',
        ]);
        $image = time() . 'general_country_logo.' .$request->file('countryImage')->getClientOriginalExtension();
        $paths = $request->file('countryImage')->storeAs('public/superadmin/generalCountrylogo/' .$image);
        $newpath = str_replace('public/' ,'',$paths);

        $country = new generalCountry;
        $country->name = $request->country;
        $country->map = $newpath;
        $saved = $country->save();
        if($saved){
            return redirect()->back()->with('success','Country has been added successfully.');
        }
        return redirect()->back()->with('fail','Country has not been added.');
    }
    public function viewGeneralCountry(){
        $viewCountry = generalCountry::get();
        return view('superadmin.viewGeneralCountry',compact('viewCountry'));
    }
}
