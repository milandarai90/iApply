<?php

namespace App\Http\Controllers;
use App\Models\country;
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
}
