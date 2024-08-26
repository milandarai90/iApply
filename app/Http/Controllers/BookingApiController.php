<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingRequest;
use Illuminate\Support\Facades\Auth;

class BookingApiController extends Controller
{
    public function book(Request $request)
    {
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
 
            $request->validate([
                'consultancy_id' => 'required|integer',
                'branch_id' => 'required|integer',
                'course_id' => 'required|integer',
                'classroom_id' => 'required|integer',
            ]);
            $bookingRequest = new BookingRequest;
            $bookingRequest->user_id = $user->id;
            $bookingRequest->consultancy_id = $request->consultancy_id;
            $bookingRequest->branch_id = $request->branch_id;
            $bookingRequest->course_id = $request->course_id;
            $bookingRequest->classroom_id = $request->classroom_id;
            $bookingRequest->status = 'book';
            if ($bookingRequest->save()) {
                return response()->json(['message' => 'Booked successfully. Wait for branch or consultancy to confirm.'], 200);
            } else {
                return response()->json(['message' => 'Booking failed. Please contact consultancy or branch.'], 500);
            }
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function AfterBookingPage()
    {
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
    
            $bookingRequestData = BookingRequest::where('user_id', $user->id)
                ->with('bookingRequest_to_consultancy.consultancyDetails', 'bookingRequest_to_branch.userBranch', 'bookingRequest_to_course', 'bookingRequest_to_classroom')
                ->get()
                ->map(function ($data) {
                    return [
                        'consultancy' => $data->bookingRequestToConsultancy->consultancyDetails->name,
                        'branch' => $data->bookingRequest_to_branch->userBranch->name,
                        'course' => $data->bookingRequest_to_course->course,
                        'classroom' => $data->bookingRequest_to_classroom->class_name,
                    ];
                });
    
            if ($bookingRequestData->isEmpty()) {
                return response()->json(['message' => 'No data found.'], 404);
            }
    
            return response()->json(['data' => $bookingRequestData], 200);
        }
    
        return response()->json(['message' => 'Unauthorized Access.'], 401);
    }
    
    
}
