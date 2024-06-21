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
            ->with('classBranch', 'course')
            ->orderBy('course_id', 'asc')
            ->get();
        return view('branch.viewClass', compact('classes'));
    }
    public function viewClass2(Request $request)
    {
        $courseid = $request->courseid;
        $uid = $request->uid;

        $token = PersonalAccessToken::where('token', $uid)->first();
        if ($token) {
            $classes = classroom::where('course_id', $courseid)
                ->with('classBranch', 'course')
                ->get();
            return view('branch.viewClass2', compact('classes', 'courseid'));
        }
        // return redirect()->back()->with('fail', 'Something went wrong...');
    }

    public function deleteClass(Request $request)
    {
        $uid = $request->uid;
        $cid = $request->cid;

        $token = PersonalAccessToken::where('token', $uid)->first();
        if ($token) {
            classroom::find($cid)->delete();
            return redirect()->back()->with('success', 'Class is deleted');
        }
        return redirect()->back()->with('fail', 'Class is not deleted');
    }

    public function editClass(Request $request)
    {
        $uid = $request->uid;
        $cid = $request->cid;
        $course = course::all();
        $class = classroom::find($cid);
        return view('branch.editClass', compact('uid', 'cid', 'course', 'class'));
    }
    public function editClass2(Request $request)
    {
        $uid = $request->uid;
        $cid = $request->cid;
        $courseid = $request->courseid;
        $course = course::all();
        $class = classroom::find($cid);
        return view('branch.editClass2', compact('uid', 'cid', 'course', 'class', 'courseid'));
    }
    public function updateClass(Request $request)
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
        $uid = $request->uid;
        $cid = $request->cid;
        $token = PersonalAccessToken::where('token', $uid)->first();
        if ($token) {
            $classroom = classroom::find($cid);
            $classroom->course_id = $request->course;
            $classroom->class_name = $request->class_name;
            $classroom->seats_number = $request->seats_number;
            $classroom->starting_time = $request->starting_time;
            $classroom->ending_time = $request->ending_time;
            $classroom->starting_date = $request->starting_date;
            $classroom->ending_date = $request->ending_date;
            $save = $classroom->save();
            if ($save) {
                return redirect()->route('branch.viewClass1')->with('success', 'Class is updated successfully.');
            }
            return redirect()->back()->with('fail', 'Class is not updated.');
        }
        return redirect()->back()->with('fail', 'No class for this branch is found.');

    }
    public function updateClass2(Request $request)
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
        $uid = $request->uid;
        $cid = $request->cid;
        $courseid = $request->courseid;
        $data = compact('uid', 'courseid', 'cid');
        $token = PersonalAccessToken::where('token', $uid)->first();
        if ($token) {
            $classroom = classroom::find($cid);
            $classroom->course_id = $request->course;
            $classroom->class_name = $request->class_name;
            $classroom->seats_number = $request->seats_number;
            $classroom->starting_time = $request->starting_time;
            $classroom->ending_time = $request->ending_time;
            $classroom->starting_date = $request->starting_date;
            $classroom->ending_date = $request->ending_date;
            $classroom->save();
            return redirect()->route('branch.viewClass2', $data)->with('success', 'Class is updated successfully.');
        }
        return redirect()->back()->with('fail', 'Class is not updated.');

    }
}
