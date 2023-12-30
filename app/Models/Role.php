<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'display_name',
        'level',
        'service_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
