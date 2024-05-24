<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultancyDashboardController extends Controller
{
    public function dashboard()
    {
        return view('consultancy.dashboard');
    }
}
