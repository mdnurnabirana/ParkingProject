<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $primaryKey = 'method_id'; 
    protected $fillable = [
        'method_name', 'details'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'payment_method', 'method_id');
    }
}
