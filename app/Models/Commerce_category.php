<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;
use App\Models\Category;

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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
