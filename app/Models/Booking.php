<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'name',
        'move_in_date',
        'move_out_date',
        'number_of_occupants',
        'approved',
        'duration',
        'message',
        'renter_id',
    ];


    // Relationships
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id'); // Assuming renter is a User model
    }


}
