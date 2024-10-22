<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'bookings'; 
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'user_id',
        'park_id',
        'booking_date',
        'total_amount',
        'payment_method',
        'transaction_number',
        'status'
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id', 'booking_id');
    }

    public function parkSpace()
    {
        return $this->belongsTo(ParkSpace::class, 'park_id', 'park_id');
    }

    public function user()
    {
        return $this->belongsTo(ParkUser::class, 'user_id', 'user_id'); 
    }
}
