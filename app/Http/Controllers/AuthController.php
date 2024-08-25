<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Mail;
use illuminate\Support\Facades\Auth;
use Hash;

class AuthController extends Controller
{
    public function registerDisplay()
    {
        if (Auth::user()) {
            $route = $this->redirectToRoute();
            return redirect($route);
        }
        return view('register');
    }
    public function loginDisplay()
    {
        if (Auth::user()) {
            $route = $this->redirectToRoute();
            return redirect($route);
        }
        return view('login');
    }

    public function redirectToRoute()
    {

        $redirect = '';
        if (Auth::user() && Auth::user()->role == 4) {
            $redirect = '/';
        } elseif (Auth::user() && Auth::user()->role == 3) {
            $redirect = '/branch/dashboard';
        } elseif (Auth::user() && Auth::user()->role == 2) {
            $redirect = '/consultancy/dashboard';
        } else {
            $redirect = '/superadmin/dashboard';
        }
        return $redirect;
    }

    public function registered(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ]);
        session([
            'register_name' => $request->name,
            'register_email' => $request->email,
            'register_password' => $request->password,
        ]);

        $otp = rand(10000, 99999);
        $expiresAt = Carbon::now()->addMinutes(10);

        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        Mail::to($request->email)->send(new SendOtpMail($otp));
        return redirect()->route('otp_form')->with('success', 'Otp is sent to your email.');
    }
    public function otp_form()
    {

        return view('emails.otp_form');
    }

    public function otp_verify(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);
        $email = session('register_email');
        $otprecord = Otp::where('email', $email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if (!$otprecord) {
            return redirect()->route('otp_form')->with('fail', 'Invalid or expired OTP. Please try again.');
        }
        $userRegister = new User;
        $userRegister->name = session('register_name');
        $userRegister->email = $email;
        $userRegister->password = Hash::make(session('register_password'));
        $userRegister->role = '4';
        $save = $userRegister->save();

        if ($save) {
            $otprecord->delete();
            $userRegister->createToken($userRegister->name . 'token');
            session()->forget(['register_name', 'register_email', 'register_password']);
            return redirect()->route('loginDisplay')->with('success', 'Registration successfull.Login to proceed.');
        } else {
            return redirect()->route('registerDisplay')->with('fail', 'Registration unsuccessfull.Please try again.');
        }
    }

    public function otp_resend(Request $request)
    { {
            $request->validate([
                'email' => 'required|email'
            ]);
            $existingOtp = Otp::where('email', $request->email)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if ($existingOtp) {
                Mail::to($request->email)->send(new SendOtpMail($existingOtp->otp));
                return redirect()->route('otp_form')->with('success', 'An OTP has already been sent. Please check your email.');
            } else {
                $otp = rand(10000, 99999);
                $expiresAt = Carbon::now()->addMinutes(10);
                Otp::create([
                    'email' => $request->email,
                    'otp' => $otp,
                    'expires_at' => $expiresAt
                ]);
                Mail::to($request->email)->send(new SendOtpMail($otp));

                return redirect()->route('otp_form')->with('success', 'A new OTP has been sent. Please check your email.');
            }
        }
    }


    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ], [
            'email.exists' => 'This email is not exist in user table.'
        ]);

        $creds = $request->only('email', 'password');

        if (Auth::attempt($creds)) {
            $route = $this->redirectToRoute();
            return redirect($route);
        } else
            return redirect()->route('loginDisplay')->with('fail', 'Invalid Email or Password');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}



