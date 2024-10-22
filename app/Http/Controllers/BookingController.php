<?php

namespace App\Http\Controllers;

use App\Models\ParkSpace;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function bookParking(Request $request)
    {
        DB::beginTransaction();

        try {
            $userJson = Session::get('user');

            if (!$userJson) {
                return redirect()->back()->with('error', 'You must be logged in to book parking.');
            }

            $user = json_decode($userJson, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->with('error', 'Failed to decode user session data.');
            }

            $userId = $user['user_id'];

            $validated = $request->validate([
                'park_id' => 'required|exists:park_spaces,park_id',
                'payment_method' => 'required|in:cash,bkash,nagad,credit_card',
                'transaction_number' => 'required'
            ]);

            $parkSpace = ParkSpace::where('park_id', $validated['park_id'])->firstOrFail();

            $booking = new Booking();
            $booking->user_id = $userId;
            $booking->park_id = $validated['park_id'];
            $booking->booking_date = now();
            $booking->total_amount = $parkSpace->park_rent;
            $booking->payment_method = $validated['payment_method'];
            $booking->transaction_number = $validated['transaction_number'];
            $booking->status = 'pending';
            $booking->save();

            $payment = new Payment();
            $payment->booking_id = $booking->id;
            $payment->payment_method = $validated['payment_method'];
            $payment->transaction_number = $validated['transaction_number'];
            $payment->amount = $parkSpace->park_rent;
            $payment->payment_status = 'pending';
            $payment->save();

            DB::commit();

            return redirect()->back()->with('success', 'Parking booked and payment details saved successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Database error occurred. Please try again later. Error details: ' . $e->getMessage());
        }
    }
}
