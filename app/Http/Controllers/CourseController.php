<?php

namespace App\Http\Controllers;

use App\Models\consultancy_branch;
use App\Models\course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\personalAccessToken;

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
    public function deleteCourse(Request $request)
    {
        $token = $request->uid;
        $id = $request->id;
        $userToken = personalAccessToken::where('token', $token)->first();
        if ($userToken) {
            $data = course::find($id);
            if ($data) {
                $data->delete();
                return redirect()->back()->with('success', 'Class is deleted successfully.');
            }
            return redirect()->back()->with('fail', 'Class is not deleted');

        }
    }
    public function updateCourse(Request $request)
    {
        $uid = $request->uid;
        $id = $request->id;
        $data = course::find($id);
        return view('branch.updateCourse', compact('uid', 'id', 'data'));
    }
    public function submitCourse(Request $request)
    {
        $request->validate([
            'course' => 'required',
        ]);
        $token = $request->uid;
        $id = $request->id;
        $uidFind = personalAccessToken::where('token', $token)->first();
        if ($uidFind) {
            $update = course::find($id);
            $update->course = $request->course;
            $update->save();
            return redirect()->route('branch.viewCourse')->with('success', 'Course is updated successfully.');
        }
        return redirect()->route('branch.viewCourse')->with('fail', 'Course is not updated.');

    }
}
