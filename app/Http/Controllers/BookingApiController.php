<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\studentsInfo;
use App\Models\Notifications;


;
use Illuminate\Support\Facades\Auth;

class BookingApiController extends Controller
{
    public function book(Request $request)
    {
        if (!Auth::guard('sanctum')->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $user = Auth::guard('sanctum')->user();
    
        $request->validate([
            'consultancy_id' => 'required|integer',
            'branch_id' => 'required|integer',
            'course_id' => 'required|integer',
            'classroom_id' => 'required|integer',
        ]);
    
        $checkBooking = BookingRequest::where('user_id', $user->id)
            ->where('consultancy_id', $request->consultancy_id)
            ->where('branch_id', $request->branch_id)
            ->where('course_id', $request->course_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('status', 'book')
            ->first();
    
        if ($checkBooking) {
            return response()->json(['message' => 'Already Booking request sent.Wait for branch or consultancy to confirm.'], 200);
        }
    
        $student = studentsInfo::where('user_id', $user->id)
            ->where('consultancy_id', $request->consultancy_id)
            ->where('branch_id', $request->branch_id)
            ->where('course_id', $request->course_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('status', 'joined')
            ->first();
    
        if ($student) {
            return response()->json(['message' => 'Already joined class.'], 400);
        }
    
        $bookingRequest = new BookingRequest;
        $bookingRequest->user_id = $user->id;
        $bookingRequest->consultancy_id = $request->consultancy_id;
        $bookingRequest->branch_id = $request->branch_id;
        $bookingRequest->course_id = $request->course_id;
        $bookingRequest->classroom_id = $request->classroom_id;
        $bookingRequest->status = 'book';
    
        if ($bookingRequest->save()) {
           
            $canceledBooking = BookingRequest::where('user_id', $user->id)
                ->where('consultancy_id', $request->consultancy_id)
                ->where('branch_id', $request->branch_id)
                ->where('course_id', $request->course_id)
                ->where('classroom_id', $request->classroom_id)
                ->where('status', 'canceled')
                ->first();
    
            if ($canceledBooking) {
                $canceledBooking->delete();
            }
            return response()->json(['message' => 'Booked successfully. Wait for branch or consultancy to confirm.'], 200);
        } else {
            return response()->json(['message' => 'Booking failed. Please contact consultancy or branch.'], 500);
        }
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
                        'consultancy' => $data->bookingRequest_to_consultancy->consultancyDetails->name,
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

    public function cancelBooking(Request $request)
    {
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
    
            $request->validate([
                'consultancy_id' => 'required|integer',
                'branch_id' => 'required|integer',
                'course_id' => 'required|integer',
                'classroom_id' => 'required|integer',
            ]);
    
            $bookingRequest = BookingRequest::where('user_id', $user->id)
                ->where('consultancy_id', $request->consultancy_id)
                ->where('branch_id', $request->branch_id)
                ->where('course_id', $request->course_id)
                ->where('classroom_id', $request->classroom_id)
                ->first();
    
            if ($bookingRequest) {
                $bookingRequest->status = 'canceled';
                if ($bookingRequest->save()) {
                    
                    $relatedBookingRequest = BookingRequest::where('user_id', $user->id)
                        ->where('consultancy_id', $request->consultancy_id)
                        ->where('branch_id', $request->branch_id)
                        ->where('course_id', $request->course_id)
                        ->where('classroom_id', $request->classroom_id)
                        ->where('status', 'book')
                        ->first();
                    
                    if ($relatedBookingRequest) {
                        $relatedBookingRequest->delete();
                    }
    
                    return response()->json(['message' => 'Booking canceled successfully.'], 200);
                } else {
                    return response()->json(['message' => 'Booking cancellation failed.'], 500);
                }
            } else {
                return response()->json(['message' => 'Booking not found.'], 404);
            }
        }
    
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    
    public function viewBookingRequest(){
        $bookingData = BookingRequest::where('consultancy_id',Auth::user()->consultancy_id)
        ->where('branch_id',Auth::user()->branch_id)
        ->where('status','book')
        ->with('bookingRequestToUser','bookingRequest_to_course','bookingRequest_to_classroom')
        ->get();
        return view('branch.viewBookingRequest',compact('bookingData'));
    }
    public function viewCanceledBookingRequest(){
        $bookingData = BookingRequest::where('consultancy_id',Auth::user()->consultancy_id)
        ->where('branch_id',Auth::user()->branch_id)
        ->where('status','canceled')
        ->with('bookingRequestToUser','bookingRequest_to_course','bookingRequest_to_classroom')
        ->get();
        return view('branch.viewCanceledBookingRequest',compact('bookingData'));
    }
    public function acceptBookingRequest(Request $request){
        $id = $request->id;

        $requestData = BookingRequest::find($id)
        ->with('bookingRequestToUser','bookingRequest_to_branch.userBranch','bookingRequest_to_consultancy.consultancyDetails')
        ->first();
        
       if($requestData){
        $addStudents = new studentsInfo;
        $addStudents->user_id = $requestData->user_id;
        $addStudents->branch_id = $requestData->branch_id;
        $addStudents->consultancy_id = $requestData->consultancy_id;
        $addStudents->course_id = $requestData->course_id;
        $addStudents->classroom_id = $requestData->classroom_id;
        $addStudents->joined_type = 'online';
        $addStudents->status = 'joined';

        if($addStudents->save()){

                  $checkBook = BookingRequest::where('id', $id)
                ->where('consultancy_id', $requestData->consultancy_id)
                ->where('user_id', $requestData->user_id)
                ->where('branch_id', $requestData->branch_id)
                ->where('course_id', $requestData->course_id)
                ->where('classroom_id', $requestData->classroom_id)
                ->where('status', 'book')
                ->first();
                if($checkBook){
                    $checkBook->delete();
                }

            $notification =  new Notifications;
            $notification->sent_to = $requestData->user_id;
            $notification->sent_by = Auth::user()->id;
            $notification->status = 'unread';
            $notification->notification = $requestData->bookingRequestToUser->name. ' your booking request to join class at '. $requestData->bookingRequest_to_branch->userBranch->name. ' of '. $requestData->bookingRequest_to_consultancy->consultancyDetails->name .' is accepted.';
            
            $notification->save();

            $requestData->delete();
            return redirect()->back()->with('success','Booking request accepted successfully.');
        }
        return redirect()->back()->with('fail','Booking request not accepted.');
       }

       return redirect()->back()->with('fail','No booking found.');

    }

    public function rejectedBookingRequest(Request $request)
    {
        if (!Auth::guard('sanctum')->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $user = Auth::guard('sanctum')->user();
        $id = $request->id;
    
        $requestData = BookingRequest::where('id',$id)
        ->with('bookingRequestToUser','bookingRequest_to_branch.userBranch','bookingRequest_to_consultancy.consultancyDetails')
        ->first();
    
        if (!$requestData) {
            return redirect()->back()->with('fail','No data found.');
        }
    
        $checkBookingData = BookingRequest::where('user_id', $user->id)
            ->where('consultancy_id', $requestData->consultancy_id)
            ->where('branch_id', $requestData->branch_id)
            ->where('course_id', $requestData->course_id)
            ->where('classroom_id', $requestData->classroom_id)
            ->where('status', 'rejected')
            ->first();
    
        if ($checkBookingData) {
            return redirect()->back()->with('fail','Booking already rejected.');
        }
    
        $requestData->status = 'rejected';
    
        if ($requestData->save()) {
            $notification =  new Notifications;
            $notification->sent_to = $requestData->user_id;
            $notification->sent_by = Auth::user()->id;
            $notification->status = 'unread';
            $notification->notification = $requestData->bookingRequestToUser->name. ' your booking request to join class at '. $requestData->bookingRequest_to_branch->userBranch->name. ' of '. $requestData->bookingRequest_to_consultancy->consultancyDetails->name .' is rejected.';
            
            $notification->save();

            return redirect()->back()->with('fail','Booking rejection successful.');
        } else {
            return redirect()->back()->with('fail','Failed to reject booking.');
        }
    }
    
    public function viewRejectedBookingRequest(){
        $bookingData = BookingRequest::
            where('status', 'rejected')
            ->get();
        return view('branch.rejectedBookingRequest',compact('bookingData'));
    }

    
}
