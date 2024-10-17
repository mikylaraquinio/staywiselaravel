<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'contact_number',
        'identification',
        'adoption_agreement',
        'status',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pet(){
        return $this->belongsTo(Pet::class);
    }

}
