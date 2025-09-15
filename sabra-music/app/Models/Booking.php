<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'center_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'purpose',
        'pdf_attachment'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
