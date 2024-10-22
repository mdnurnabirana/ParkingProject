<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ParkSpace;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->session()->has('admin_id')) {
                return redirect('/admin/login')->withErrors(['Please log in to access this page.']);
            }
            return $next($request);
        });
    }

    public function viewPendingRequests()
    {
        $pendingBookings = Booking::where('status', 'pending')->get();
        return view('admin.pending_requests', compact('pendingBookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,completed,canceled',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;

        if ($request->status == 'pending') {
            $booking->start_time = Carbon::now();
            $booking->end_time = Carbon::now()->addHour();
        }

        $booking->save();

        return redirect()->route('admin.viewPendingRequests')->with('success', 'Booking status updated successfully.');
    }

    public function autoDeleteExpiredBookings()
    {
        $currentTime = Carbon::now();
        Booking::where('end_time', '<=', $currentTime)->delete();
    }
}