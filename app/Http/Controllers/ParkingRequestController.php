<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ParkingRequestController extends Controller
{
    public function showRequests(Request $request)
    {
        if (!Session::has('user')) {
            return redirect()->back()->with('error', 'You must be logged in to view bookings.');
        }

        $userId = Session::get('user')['user_id'];

        $status = $request->input('status', 'pending'); 

        $validStatuses = ['pending', 'confirmed', 'canceled', 'completed'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status selected.');
        }

        $bookings = DB::table('bookings')
            ->where('user_id', $userId)
            ->where('status', $status)
            ->get();

        return view('park_spaces.parking-request', compact('bookings', 'status'));
    }
}
