<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable=[
        'commerce_id',
        'day_id',
        'open',
        'close',
        'shift'
    ];
}
