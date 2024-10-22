<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function showProfile()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'You need to be logged in to view this page.');
        }

        $user = Session::get('user');
        return view('profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = Session::get('user');

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'vehicle_type' => 'required|string|max:255',
            'vehicle_reg_no' => 'required|string|max:255',
            'user_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vehicle_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update user information
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->mobile = $request->input('mobile');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');
        $user->vehicle_type = $request->input('vehicle_type');
        $user->vehicle_reg_no = $request->input('vehicle_reg_no');

        if ($request->hasFile('user_pic')) {
            $userPicPath = $request->file('user_pic')->store('user_pics', 'public');
            $user->user_pic = $userPicPath;
        }

        if ($request->hasFile('vehicle_pic')) {
            $vehiclePicPath = $request->file('vehicle_pic')->store('vehicle_pics', 'public');
            $user->vehicle_pic = $vehiclePicPath;
        }

        $user->save();
        Session::put('user', $user);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = DB::table('park_users')->where('user_id', Session::get('user')->user_id)->first();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        DB::table('park_users')->where('user_id', $user->user_id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password successfully changed.');
    }
}