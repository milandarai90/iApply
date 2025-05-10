<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\consultancy_info;
use App\Models\country;
use App\Models\course;
use App\Models\classroom;
use App\Models\country_guidelines;
use Carbon\Carbon;
use App\Models\Otp;
use App\Mail\SendOtpMail;
use App\Models\BookingRequest;
use App\Models\consultancy_branch;
use App\Models\generalCountry;
use App\Models\generalCountryGuidelines;
use App\Models\studentsInfo;
use Throwable;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(['message' => 'Email already registered'], 409);
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'c_password' => 'required|string|min:8|same:password'
        ]);

        $otp = rand(10000, 99999);
        $expiresAt = Carbon::now()->addMinutes(10);
            Otp::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => $expiresAt]
        );
            Mail::to($request->email)->send(new SendOtpMail($otp));
        return response()->json(['message' => 'OTP sent to your email'], 200);
    }



    public function verifyOtp(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'otp' => 'required|string|max:6',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'c_password' => 'required|string|min:8|same:password'
        ]);

        $otpRecord = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = '4';
        $user->password = Hash::make($request->password);
        $user->save();
        $user->createToken($user->name . 'token');
        $otpRecord->delete();

        return response()->json(['message' => 'User registered successfully'], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password')) && Auth::user()->role == 4) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            return response()->json(['token' => $token ,'email'=>$user->email], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        $oldOtp = Otp::where('email', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if ($oldOtp) {
            Mail::to($request->email)->send(new SendOtpMail($oldOtp->otp));
            $response = [
                'message' => 'Otp has already been sent. Please check your email',
            ];
            return response()->json($response, 200);
        } else {
            $otp = rand(10000, 99999);
            $expiresAt = Carbon::now()->addMinutes(10);

            Otp::create([
                "email" => $request->email,
                "otp" => $otp,
                "expires_at" => $expiresAt,
            ]);
            Mail::to($request->email)->send(new SendOtpMail($otp));
            $response = [
                'message' => 'Otp has been sent. Please check your email.',
            ];
            return response()->json($response, 200);
        }
    }

    public function home()
    {
        // Check if the user is authenticated
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();

            if($user->role ==4){
                $consultancy = consultancy_info::with('consultancyDetails','consultancyDetails.userToProfileImage')
                ->get()
                ->map(function($consultancyDetails){

                    $branch = consultancy_branch::where('consultancy_id',$consultancyDetails->id)
                    ->with('userBranch','userBranch.userToProfileImage','classBranch','branchCourse')
                    ->get()
                    ->map(function($branchDetails) use ($consultancyDetails){

                        $course = course::where('consultancy_id',$branchDetails->consultancy_id)
                        ->where('branch_id',$branchDetails->id)
                        ->with('course')
                        ->get()
                        ->map(function ($course) use ($branchDetails){


                           $classDetails = classroom::with('students')->where('branch_id',$branchDetails->id)
                            ->where('course_id',$course->id)
                            ->get();

                            // $studentCount = $classDetails->students->count();

                            $classCount = $classDetails->count();

                           $classDetails= $classDetails->map(function ($class) use ($course , $classCount, $classDetails){

                                return[
                                    'id'=>$class->id,
                                    'class_name'=>$class->class_name,
                                    'students_number' =>count($class->students),
                                    'seat_numbers'=>$class->seats_number,
                                    'status'=>$class->status,
                                    'start_time'=>$class->starting_time,
                                    'end_time'=>$class->ending_time,
                                    'start_date'=>$class->starting_date,
                                    'end_date'=>$class->ending_date,
                                ];
                            });

                            return[
                                'id' => $course->id,
                                'course_title'=>$course->course,
                                'class_details' => $classDetails->isNotEmpty() ? $classDetails : null
                            ];
                        });

                        return[
                            'id'=>$branchDetails->id,
                            'name'=>$branchDetails->userBranch->name,
                            'email'=>$branchDetails->userBranch->email,
                            'phone'=>$branchDetails->userBranch->phone,
                            'u_district'=>$branchDetails->userBranch->u_district,
                            'u_municipality'=>$branchDetails->userBranch->u_municipality,
                            'u_ward'=>$branchDetails->userBranch->u_ward,
                            'photo' => $branchDetails->userBranch->userToProfileImage ?  url(asset('storage/'.$branchDetails->userBranch->userToProfileImage->image_path)):null,
                            'course_details' => $course,
                        ];

                    });


                    $country = country::where('consultancy_id',$consultancyDetails->id)
                    ->with('country_to_guidelines')
                    ->get()
                    ->map(function($countryData){

                        $guidelines = country_guidelines::where('consultancy_id',$countryData->consultancy_id)
                        ->where('country_id',$countryData->id)
                        ->get()
                        ->map(function ($guide) use ($countryData){

                            return[
                               'process'=>$guide->guidelines
                            ];
                        });

                        return[
                            'country'=>$countryData->name,
                            'map'=>$countryData->country_map ? url('storage/'. $countryData->country_map) : null,
                            'guidelines'=> $guidelines->isNotEmpty() ?$guidelines:null,
                        ];
                    });


                    return [
                        'id'=>$consultancyDetails->id,
                        'name'=>$consultancyDetails->consultancyDetails->name,
                        'email'=>$consultancyDetails->consultancyDetails->email,
                        'phone'=>$consultancyDetails->consultancyDetails->phone,
                        'u_district'=>$consultancyDetails->consultancyDetails->u_district,
                        'u_municipality'=>$consultancyDetails->consultancyDetails->u_municipality,
                        'u_ward'=>$consultancyDetails->consultancyDetails->u_ward,
                        'photo' => $consultancyDetails->consultancyDetails->userToProfileImage ?  url(asset('storage/'.$consultancyDetails->consultancyDetails->userToProfileImage->image_path)):null,
                        'branch_details'=> $branch,
                        'country_details'=>$country->isNotEmpty() ? $country :null,

                    ];
                });
                $generalCountry = generalCountry::get()
                ->map(function ($generalCountryDetails){

                    $generalCountryGuidelines = generalCountryGuidelines::where('generalCountry_id',$generalCountryDetails->id)
                    ->get()
                    ->map(function ($guidelines) use ($generalCountryDetails){

                        return[
                            'id'=>$guidelines->id,
                            'Guidelines'=> $guidelines->guidelines,
                        ];
                    });

                    return[
                        'id'=> $generalCountryDetails->id,
                        'country'=>$generalCountryDetails->name,
                        'map'=> url(asset('storage/'.$generalCountryDetails->map)),
                        'guidelines'=>$generalCountryGuidelines,
                    ];

                } );
                return response()->json(['consultancy_details'=> $consultancy,'general_country'=>$generalCountry]);
            }

        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }

    public function bookingRequested(Request $request){
        try{
            $auth = Auth::user();
            $requests = BookingRequest::where('user_id', $auth->id)->where('status', 'book')->get();
            $consultancyName = User::where('consultancy_id', $requests->consultancy_id)->first()->name;
            $branchName = User::where('branch_id',$requests->branch_id)->first()->name;
            $courseName = course::find($requests->course_id)->course;
            $classroomName = classroom::find($requests->classroom_id)->class_name;
            $response = $requests->toArray();
            $response['consultancy'] = $consultancyName;
            $response['branch'] = $branchName;
            $response['course'] = $courseName;
            $response['classroom'] = $classroomName;
            return response()->json($response, 200);
        }catch(Throwable $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
