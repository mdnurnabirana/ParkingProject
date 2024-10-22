<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'park_id',
        'booking_date',
        'total_amount',
        'payment_method',
        'transaction_number',
        'status',
    ];

    protected $dates = ['booking_date']; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parkSpace()
    {
        return $this->belongsTo(ParkSpace::class, 'park_id');
    }
}
