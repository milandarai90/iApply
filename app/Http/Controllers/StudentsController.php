<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\course;
use App\Models\PersonalAccessToken;
use App\Models\studentsInfo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'studentName' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:10|min:10',
            'u_district' => 'required',
            'u_municipality' => 'required',
            'u_ward' => 'required',
            'classes' => 'required',
            'course' => 'required',
            'joining_date' => 'required',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password'
        ]);
        $user = new User();
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
            $student = new studentsInfo();
            $student->user_id = $user->id;
            $student->branch_id = Auth::user()->branch_id;
            $student->consultancy_id = Auth::user()->consultancy_id;
            $student->classroom_id = $request->classes;
            $student->course_id = $request->course;
            $student->joined_type = 'physical';
            $student->joining_date = $request->joining_date;
            $student->status = $request->status;
            $student->save();
            $user->createToken($user->name . 'token');
            return redirect()->route('branch.addStudents')->with('success', 'Student is registered successfully');
        } else {
            $user->delete();
            return redirect()->route('branch.addStudents')->with('fail', 'Student is not registered');
        }
    }
    public function joinedStudents()
    {

        $user = PersonalAccessToken::where('token', Auth::user()->personalAccessTokens->first()->token);
        if ($user) {
            $student = studentsInfo::where('branch_id', Auth::user()->branch_id)
                ->get();
            if ($student) {
                $students = studentsInfo::where('status', 'joined')
                    ->with('student', 'classes')
                    ->get();
                return view('branch.joinedStudents', compact('students', 'user'));
            }
        }
    }
    public function bookedStudents()
    {
        $user = PersonalAccessToken::where('token', Auth::user()->personalAccessTokens->first()->token);
        if ($user) {
            $student = studentsInfo::where('branch_id', Auth::user()->branch_id)
                ->get();
            if ($student) {
                $students = studentsInfo::where('status', 'booked')
                    ->with('student', 'classes')
                    ->get();
                return view('branch.bookedStudents', compact('students', 'user'));
            }
        }
    }
    public function completedStudents()
    {

        $user = PersonalAccessToken::where('token', Auth::user()->personalAccessTokens->first()->token);
        if ($user) {
            $student = studentsInfo::where('branch_id', Auth::user()->branch_id)
                ->get();
            if ($student) {
                $students = studentsInfo::where('status', 'completed')
                    ->with('student', 'classes')
                    ->get();
                return view('branch.completedStudents', compact('students', 'user'));
            }
        }
    }
    public function viewStudents()
    {

        $user = PersonalAccessToken::where('token', Auth::user()->personalAccessTokens->first()->token);
        if ($user) {
            $students = studentsInfo::where('branch_id', Auth::user()->branch_id)
                ->with('student', 'classes')
                ->get();
            return view('branch.viewStudents', compact('students', 'user'));
        }
    }
}
