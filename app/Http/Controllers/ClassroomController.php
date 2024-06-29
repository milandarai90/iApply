<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\course;
use App\Models\User;
use App\Models\studentsInfo;
use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $classes = Classroom::where('branch_id', Auth::user()->branch_id)
            ->with('classBranch', 'course', 'students')
            ->orderBy('course_id', 'asc')
            ->get();
        foreach ($classes as $class) {
            $class->studentCount = StudentsInfo::where('classroom_id', $class->id)->count();
        }
        return view('branch.viewClass', compact('classes'));

    }
    public function viewClass2(Request $request)
    {
        $courseid = $request->courseid;
        $uid = $request->uid;
        $token = PersonalAccessToken::where('token', $uid)->first();
        if ($token) {
            $classes = classroom::where('course_id', $courseid)
                ->with('classBranch', 'course', 'students')
                ->get();
            foreach ($classes as $class) {
                $class->studentCount = StudentsInfo::where('classroom_id', $class->id)->count();
            }
            return view('branch.viewClass2', compact('classes', 'courseid', 'uid'));
        }
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
    public function addStudents1(Request $request)
    {
        $uid = $request->uid;
        $cid = $request->cid;
        $courseid = $request->courseid;
        return view('branch.addStudents1', compact('uid', 'cid', 'courseid'));
    }
    public function postStudents1(Request $request)
    {
        $uid = $request->uid;
        $cid = $request->cid;
        $courseid = $request->courseid;
        $request->validate([
            'studentName' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:10|min:10',
            'u_district' => 'required',
            'u_municipality' => 'required',
            'u_ward' => 'required',
            'joining_date' => 'required',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password'
        ]);
        $findUser = PersonalAccessToken::where('token', $uid)->first();
        if ($findUser) {
            $user = new User;
            $user->name = $request->studentName;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->consultancy_id = Auth::user()->consultancy_id;
            $user->branch_id = Auth::user()->branch_id;
            $user->u_district = $request->u_district;
            $user->u_municipality = $request->u_municipality;
            $user->u_ward = $request->u_ward;
            $user->role = '4';
            $user->password = hash::make($request->password);
            $save = $user->save();
            if ($save) {
                $student = new studentsInfo;
                $student->user_id = $user->id;
                $student->branch_id = Auth::user()->branch_id;
                $student->consultancy_id = Auth::user()->consultancy_id;
                $student->classroom_id = $cid;
                $student->course_id = $courseid;
                $student->joined_type = 'physical';
                $student->joining_date = $request->joining_date;
                $student->status = $request->status;
                $student->save();
                $user->createToken($user->name . 'token');
                return redirect()->route('branch.viewClass1')->with('success', 'Student is registered successfully');
            } else {
                $user->delete();
                return redirect()->route('branch.addStudents1')->with('fail', 'Student is not registered');
            }
        }
    }
    public function addStudents2(Request $request)
    {
        $uid = $request->uid;
        $cid = $request->cid;
        $courseid = $request->courseid;
        return view('branch.addStudents2', compact('uid', 'cid', 'courseid'));
    }
    public function postStudents2(Request $request)
    {
        $uid = $request->uid;
        $cid = $request->cid;
        $courseid = $request->courseid;
        $request->validate([
            'studentName' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:10|min:10',
            'u_district' => 'required',
            'u_municipality' => 'required',
            'u_ward' => 'required',
            'joining_date' => 'required',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password'
        ]);
        $findUser = PersonalAccessToken::where('token', $uid)->first();
        if ($findUser) {
            $user = new User;
            $user->name = $request->studentName;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->consultancy_id = Auth::user()->consultancy_id;
            $user->branch_id = Auth::user()->branch_id;
            $user->u_district = $request->u_district;
            $user->u_municipality = $request->u_municipality;
            $user->u_ward = $request->u_ward;
            $user->role = '4';
            $user->password = hash::make($request->password);
            $save = $user->save();
            if ($save) {
                $student = new studentsInfo;
                $student->user_id = $user->id;
                $student->branch_id = Auth::user()->branch_id;
                $student->consultancy_id = Auth::user()->consultancy_id;
                $student->classroom_id = $cid;
                $student->course_id = $courseid;
                $student->joined_type = 'physical';
                $student->joining_date = $request->joining_date;
                $student->status = $request->status;
                $student->save();
                $user->createToken($user->name . 'token');
                return redirect()->route('branch.viewClass2', ['uid' => $uid, 'cid' => $cid, 'courseid' => $courseid])->with('success', 'Student is registered successfully');
            } else {
                $user->delete();
                return redirect()->route('branch.addStudents2')->with('fail', 'Student is not registered');
            }
        }
    }
}
