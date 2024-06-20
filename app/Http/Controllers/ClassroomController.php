<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\course;
use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function addClass()
    {

        $course = course::where('branch_id', Auth::user()->branch_id)->get();
        return view('branch.addClass', compact('course'));
    }
    public function postClass(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
            'seats_number' => 'required',
            'starting_time' => 'required',
            'course' => 'required',
            'ending_time' => 'required',
            'starting_date' => 'required',
            'ending_date' => 'required',
        ]);
        $classroom = new classroom;
        $classroom->branch_id = Auth::user()->branch_id;
        $classroom->course_id = $request->course;
        $classroom->class_name = $request->class_name;
        $classroom->seats_number = $request->seats_number;
        $classroom->starting_time = $request->starting_time;
        $classroom->ending_time = $request->ending_time;
        $classroom->starting_date = $request->starting_date;
        $classroom->ending_date = $request->ending_date;
        $save = $classroom->save();
        if ($save) {
            return redirect()->back()->with('success', 'Class is added successfully.');
        }
        return redirect()->back()->with('fail', 'Class is not added.');
    }

    public function viewClass()
    {
        $course = course::with('branchCourse')->get();
        return view('branch.class', compact('course'));
    }
    public function viewClass1()
    {
        $classes = classroom::where('branch_id', Auth::user()->branch_id)
            ->orderBy('course_id', 'asc')->get();
        return view('branch.viewClass', compact('classes'));
    }
    public function viewClass2(Request $request)
    {
        $cid = $request->cid;
        $uid = $request->uid;

        $token = PersonalAccessToken::where('token', $uid)->first();
        if ($token) {
            $classes = classroom::where('course_id', $cid)->get();
            return view('branch.viewClass2', compact('classes'));
        }
        return redirect()->back()->with('fail', 'Something went wrong...');
    }
}
