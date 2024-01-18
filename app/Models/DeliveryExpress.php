<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Route;
use App\Models\User;
use App\Models\Commerce;
use App\Models\History_payment;

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
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }

    public function payment()
    {
        return $this->hasOne(History_payment::class, 'express_id');
    }


}
