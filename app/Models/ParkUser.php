<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ParkUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'park_users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'fname', 'lname', 'mobile', 'email', 'password', 'vehicle_type',
        'vehicle_reg_no', 'vehicle_pic', 'address', 'gender', 'user_pic', 'profile_pic', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
