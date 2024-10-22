<?php

namespace App\Http\Controllers\Auth;

use App\Models\ParkUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validateRegistration($request);

        $data = $request->all();

        if ($request->hasFile('user_pic')) {
            $data['user_pic'] = $request->file('user_pic')->store('user_pics', 'public');
        }

        if ($request->hasFile('vehicle_pic')) {
            $data['vehicle_pic'] = $request->file('vehicle_pic')->store('vehicle_pics', 'public');
        }


        $user = $this->create($data);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    protected function validateRegistration(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'mobile' => 'required|string|max:20|unique:park_users',
            'email' => 'required|string|email|max:255|unique:park_users',
            'password' => 'required|string|min:4|confirmed',
            'user_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate user_pic
            'vehicle_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate vehicle_pic
        ]);
    }

    protected function create(array $data)
    {
        return ParkUser::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'vehicle_type' => $data['vehicle_type'] ?? null,
            'vehicle_reg_no' => $data['vehicle_reg_no'] ?? null,
            'vehicle_pic' => $data['vehicle_pic'] ?? null,  
            'address' => $data['address'] ?? null,
            'gender' => $data['gender'] ?? null,
            'user_pic' => $data['user_pic'] ?? null,  
            'status' => 'active',
        ]);
    }
}
