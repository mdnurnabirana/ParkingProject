<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkSpace;

class AdminController extends Controller
{
    public function showAddParkSpaceForm()
    {
        return view('admin.add-park-space');
    }

    public function addParkSpace(Request $request)
    {
        $validatedData = $request->validate([
            'park_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'park_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'park_facilities' => 'nullable|string',
            'park_rent' => 'nullable|numeric',
            'payment_method' => 'nullable|string',
            'bkash_number' => 'nullable|string',
            'nagad_number' => 'nullable|string',
            'total_spaces' => 'required|integer',
            'available_spaces' => 'required|integer',
            'owner_number' => 'required|string',
            'availability_time' => 'required|string',
            'status' => 'required|string|in:active,inactive,maintenance',
        ]);

        $parkPicPath = null;
        if ($request->hasFile('park_pic')) {
            $parkPicPath = $request->file('park_pic')->store('parkspaces', 'public');
        }

        $adminId = session('admin_id'); 

        ParkSpace::create([
            'park_name' => $validatedData['park_name'],
            'address' => $validatedData['address'],
            'park_pic' => $parkPicPath,
            'park_facilities' => $validatedData['park_facilities'],
            'park_rent' => $validatedData['park_rent'],
            'payment_method' => $validatedData['payment_method'],
            'bkash_number' => $validatedData['bkash_number'],
            'nagad_number' => $validatedData['nagad_number'],
            'total_spaces' => $validatedData['total_spaces'],
            'available_spaces' => $validatedData['available_spaces'],
            'owner_number' => $validatedData['owner_number'],
            'availability_time' => $validatedData['availability_time'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('admin.addParkSpace')->with('success', 'Park space added successfully!');
    }
}
