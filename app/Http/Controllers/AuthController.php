<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registerDisplay()
    {
        return view('register');
    }
    public function loginDisplay()
    {
        return view('login');
    }
}
