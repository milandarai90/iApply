<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Session;
use illuminate\Support\Facades\Auth;
use Hash;

class AuthController extends Controller
{
    public function registerDisplay()
    {
        // if (Auth::user()) {
        //     $route = $this->redirectToRoute();
        //     return redirect($route);
        // }
        return view('register');
    }
    public function loginDisplay()
    {
        // if (Auth::user()) {
        //     $route = $this->redirectToRoute();
        //     return redirect($route);
        // }
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
        $userRegister = new user;
        $userRegister->name = $request->name;
        $userRegister->email = $request->email;
        $userRegister->password = Hash::make($request->password);
        $userRegister->role = ('4');
        $save = $userRegister->save();
        if ($save) {
            $userRegister->createToken($userRegister->name . 'token');
            return view('login')->with('success', 'Registration successfull.Loginn to proceed.');
        } else {
            return redirect()->back()->with('fail', 'Registration unsuccessfull.Please try again.');
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
            return view('login')->with('fail', 'Invalid Email or Password');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}



