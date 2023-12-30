<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;

class Commerce_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'commerce_id',
        'category_id'
    ];

    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }
}
