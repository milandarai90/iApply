<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\consultancy_info; // Correct import statement
use App\Models\country; // Correct import statement
use Carbon\Carbon;
use App\Models\Otp;
use App\Mail\SendOtpMail; // Import the SendOtpMail class
use App\Models\consultancy_branch;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'c_password' => 'required|string|min:8|same:password'
        ]);
        $otp = rand(10000, 99999);
        $expiresAt = Carbon::now()->addMinutes(10);
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);
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

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
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

                        return[
                            'id'=>$branchDetails->id,
                            'name'=>$branchDetails->userBranch->name,
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
                    ];
                });
                return response()->json(['consultancy_details'=> $consultancy]);
            }

        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }
}