<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->input('email_or_mobile');  
        $password = $request->input('password');       

        $user = ParkUser::where('email', $input)
                        ->orWhere('mobile', $input)
                        ->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email_or_mobile' => 'Invalid email or mobile number.']);
        }

        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Invalid password.']);
        }

        Session::put('user', $user);
        return redirect('/')->with('success', 'You are now logged in.');
    }

    public function logout()
    {
        Session::forget('user');

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
