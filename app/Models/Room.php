<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'room';

    protected $fillable = [
        'room_title',
        'location',
        'description',
        'price',
        'amenities',
        'room_type',
        'image',
        'status',
        'owner_id', // Ensure this is included if you're referencing the owner
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default.png');
    }

    public function index()
{
    $dorms = Dorm::all(); // Fetch all dorms from the database
    return view('your-view-name', compact('dorms'));
}

}
