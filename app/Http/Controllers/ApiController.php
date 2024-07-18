<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Otp;
use App\Mail\SendOtpMail; // Import the SendOtpMail class

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
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'token' => $token->token,
                'user' => $user->name,
            ]);
        }

        return response()->json(['error' => 'Invalid email or password.'], 401);
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
    public function home() {
        if (Auth::check() && Auth::user()->role === 4) {
            $consultancies = consultancy_infos::with('consultancyDetails', 'branch')->get();
            $countries = country::with('country_to_consultancy')->get();
            $home = [];
    
            if ($consultancies->isNotEmpty()) {
                foreach ($consultancies as $consultancy) {
                    $home[] = [
                        'consultancy_id' => $consultancy->id,
                        'consultancy_name' => $consultancy->consultancyDetails->name,
                    ];
                }
            }
    
            if ($countries->isNotEmpty()) {
                foreach ($countries as $country) {
                    $home[] = [
                        'country_id' => $country->id,
                        'country_name' => $country->name,
                    ];
                }
            }
    
            if (!empty($home)) {
                return response()->json(['home_data' => $home]);
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }
    

    // public function home(){
    //     if(Auth::user() && auth::user()->role === 4){
    //         $consultancies = consultancy_infos::all()
    //         ->with('consultancyDetails','branch')
    //         ->get();
    //         $countries = country::all()
    //         ->with('country_to_consultancy')
    //         ->get();
    //         $home = [];
    //         if($consultancies->isNotEmpty()){
    //             foreach($consultancies as $consultancies){
    //             $consultancyHome[] = [
    //               'consultancy_id'=>$consultancies->id,
    //                 'consultancy_name'=> $consultancies->consultancyDetails->name,
    //               ];
    //               array_push($home,$consultancyHome);
    //           }
    //        }
    //        if($countries->isNotEmpty()){
    //             foreach($countries as $countries){
    //             $countryHome[]=[
    //                 'country_id'=>$countries->id,
    //                 'country_name'=>$countries->name,
    //             ];
    //             array_push($home,$countryHome);
    //         }
    //         return response()->json(['home_data'=>$home]);
    //        }else{
    //         $response = ['message' => 'Data not found'];
    //         return response()->json($response, 404);
    //        }
    //     }
    // }
}


