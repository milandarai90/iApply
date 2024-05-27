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

    }
}
