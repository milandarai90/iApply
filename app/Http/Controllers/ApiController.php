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

        // Generate OTP
        $otp = rand(10000, 99999);
        $expiresAt = Carbon::now()->addMinutes(10);

        // Save OTP to database
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        // Send OTP to user's email
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

        // Create user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = '4';
        $user->password = Hash::make($request->password);
        $user->save();
        $user->createToken($user->name . 'token');
        // Delete OTP record
        $otpRecord->delete();

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {

        $creds = $request->only('email', 'password');
        if (Auth::attempt($creds)) {
            $user = Auth::user();
            $response = [
                'name' => $user->name,
                'email' => $user->email,
                'message' => 'Login is successfull.'
            ];
            return response()->json($response, 200);
        }
        $response = [
            'message' => 'Invalid email or password'
        ];
        return response()->json($response, 404);
    }
}


