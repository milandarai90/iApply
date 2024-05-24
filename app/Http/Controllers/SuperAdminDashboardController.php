<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }
}
