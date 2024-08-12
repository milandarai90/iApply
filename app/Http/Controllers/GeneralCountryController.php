<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralCountryController extends Controller
{
    public function addGeneralCountry(){
        return view('superadmin.addGeneralCountry');
    }
}
