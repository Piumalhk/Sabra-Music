<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'location',
        'description',
        'price_per_hour',
        'image',
        'is_active'
    ];
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
