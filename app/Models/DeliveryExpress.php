<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Route;
use App\Models\User;
use App\Models\Commerce;

class DeliveryExpress extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'route_id',
        'type',
        'user_id',
        'commerce_id',
        'amount',
        'paid',
        'status',
        'comment',
        'driver_id',
        'updated_by',
        'confirmed'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }


}
