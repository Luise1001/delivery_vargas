<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Location extends Model
{
    use HasFactory;

    protected $fillable=[
        'latitude',
        'longitude',
        'address',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
