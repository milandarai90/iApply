<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function addClass()
    {
        return view('branch.addClass');
    }
    public function postClass(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
            'seats_number' => 'required',
            'starting_time' => 'required',
            'ending_time' => 'required',
            'starting_date' => 'required',
            'ending_date' => 'required',
        ]);
        // $classroom = new classroom;
        // $classroom->branchclass_id
        $data = auth::user()->userBranch->id;
        dd($data);

    }
}
