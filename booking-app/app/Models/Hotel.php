<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'address',
        'city',
        'phone',
        'email',
        'image',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
