<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarwashPrice extends Model
{
    use HasFactory;

    protected $table = 'carwash_prices';

    protected $fillable = ['service_id', 'car_id', 'amount'];


    public function service()
    {
        return $this->belongsTo(CarwashService::class, 'service_id');
    }


    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
