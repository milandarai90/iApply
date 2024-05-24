<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminUsersControllers extends Controller
{
    public function users()
    {
        return view('superadmin.allUsers');
    }
}
