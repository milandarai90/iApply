<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function addStudents()
    {
        return view('branch.addStudents');
    }
}
