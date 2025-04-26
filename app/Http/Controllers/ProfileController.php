<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileImage;
use App\Models\User;
use Auth;
class ProfileController extends Controller
{
    public function profile(){
       $user = ProfileImage::where('user_id',Auth::user()->id)
       ->latest()->first();
    //    dd($user);
       return view('profile',compact('user'));
    }
    public function addProfile(){
        return view('addProfile');
    }
    public function postProfile(Request $request){
        $request->validate([
            'profilePicture'=> 'required|image|mimes:jpeg,jpg,png,gif,webp'
        ]);
        $images = time() . 'profilePictures.'.$request->file('profilePicture')->getClientOriginalExtension();
        $paths = $request->file('profilePicture')->storeAs('public/profile_picture/'.$images);
        $profilePicture = str_replace('public/', '', $paths);

        ProfileImage::where('user_id', Auth::id())->delete();
        $profileImage = new ProfileImage;
        $profileImage->user_id = Auth::user()->id;
        $profileImage->image_path = $profilePicture;
        $profileImage->save();
         return redirect('/addProfile')->with('success','photo is uploaded.');
    }
}
