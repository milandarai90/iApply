<?php

namespace App\Http\Controllers;

use App\Models\consultancy_branch;
use App\Models\course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    public function addCourse()
    {
        $branch = consultancy_branch::all();
        return view('branch.addCourse', compact('branch'));
    }
    public function postCourse(Request $request)
    {
        $request->validate([
            'course' => 'required',
        ]);
        $course = new course;
        $course->course = $request->course;
        $course->branch_id = Auth::user()->branch_id;
        $course->consultancy_id = Auth::user()->consultancy_id;
        $save = $course->save();
        if ($save) {
            return redirect()->back()->with('success', 'Course is added successfully.');
        }
        return redirect()->back()->with('fail', 'Course is not added.');
    }
    public function viewCourse()
    {
        $course = course::where('branch_id', Auth::user()->branch_id)->with('branchCourse')->get();
        return view('branch.viewCourse', compact('course'));
    }
    public function deleteCourse()
    {

    }
}
