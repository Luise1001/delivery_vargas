<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firebase_Key extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'user_id',
        'role_id'
    ];
}
