<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkSpace extends Model
{
    use HasFactory;
    protected $table = 'park_spaces';
    protected $primaryKey = 'park_id';

    protected $fillable = [
        'park_name',
        'address',
        'park_pic',
        'park_facilities',
        'park_rent',
        'payment_method',
        'bkash_number',
        'nagad_number',
        'total_spaces',
        'available_spaces',
        'owner_number',
        'availability_time',
        'status',
    ];

    protected $hidden = [
        'bkash_number',
        'nagad_number',
    ];

    protected $casts = [
        'park_rent' => 'decimal:2',
        'total_spaces' => 'integer',
        'available_spaces' => 'integer',
    ];

    public function getParkPicUrlAttribute()
    {
        return $this->park_pic ? asset('storage/parkspaces/' . $this->park_pic) : null;
    }

}
