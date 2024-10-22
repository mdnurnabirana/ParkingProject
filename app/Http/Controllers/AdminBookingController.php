<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class AdminBookingController extends Controller
{
    public function manageBookings(Request $request)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/admin/login')->withErrors(['Please log in to access this page.']);
        }

        $bookings = Reservation::with(['payment', 'parkSpace', 'user'])->get();

        return view('admin.managebookings', [
            'bookings' => $bookings,
            'adminName' => session('adminName')
        ]);
    }

    public function updateBooking(Request $request, $id)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/admin/login')->withErrors(['Please log in to access this page.']);
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,canceled,completed', 
        ]);

        $booking = Reservation::findOrFail($id);
        $booking->update(['status' => $request->status]); 

        return redirect()->route('admin.manageBookings')->with('success', 'Booking status updated successfully.');
    }

    public function deleteBooking(Request $request, $id)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/admin/login')->withErrors(['Please log in to access this page.']);
        }

        $booking = Reservation::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.manageBookings')->with('success', 'Booking deleted successfully.');
    }
}
