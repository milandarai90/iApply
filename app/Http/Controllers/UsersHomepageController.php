<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersHomepageController extends Controller
{
    public function index()
    {
        return view('users.homepage');
    }
}
