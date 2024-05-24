<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BranchDashboardController extends Controller
{
    public function dashboard()
    {
        return view('branch.dashboard');
    }
}
