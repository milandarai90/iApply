<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\studentsInfo;
use Illuminate\Support\Facades\Auth;

class BranchDashboardController extends Controller
{
    public function dashboard()
    {
        $bookingRequest = BookingRequest::where('status','book')
        ->get();
        $bookingRequestCount = $bookingRequest->count();

        $students = studentsinfo::where('consultancy_id',Auth::user()->consultancy_id)
        ->where('branch_id',Auth::user()->branch_id);

        $studentsCount = $students->count();
        return view('branch.dashboard',compact('bookingRequestCount','studentsCount'));
    }
}
