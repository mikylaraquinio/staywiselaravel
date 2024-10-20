<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    // Fields that can be mass assigned
    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'student_id',
        'move_in_date',
        'duration',
        'message'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
