<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'day'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}

