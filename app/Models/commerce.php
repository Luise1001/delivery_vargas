<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Commerce_category;
use App\Models\Static_location;

class Commerce extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'document',
        'name',
        'phone',
        'active',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commerce_category()
    {
        return $this->hasMany(Commerce_category::class);
    }

    public function static_location()
    {
        return $this->hasMany(Static_location::class, 'user_id');
    }
}
