<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function addStudents()
    {
        $course = course::where('consultancy_id', Auth::user()->consultancy_id)->get();
        $classroom = classroom::where('branch_id', Auth::user()->branch_id)->get();
        return view('branch.addStudents', compact('course', 'classroom'));
    }

    public function postStudents(Request $request)
    {
        $request->validate([

        ]);
    }
}
