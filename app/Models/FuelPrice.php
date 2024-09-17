<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelPrice extends Model
{
    use HasFactory;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    protected $fillable = [
        'fuel_type_id',
        'price_per_unit',
        'quantity',
        'status',
        'additional_data',
        'main_price',
        'status'
    ];

    protected $casts = [
        'additional_data' => 'array',
    ];

    /**
     * Get the fuel type associated with the fuel price.
     */
    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => match($value) {
                self::STATUS_ACTIVE => '<div class="badge badge-success">' . trans('messages.status_active') . '</div>',
                self::STATUS_INACTIVE => '<div class="badge badge-secondary">' . trans('messages.status_inactive') . '</div>',
                default => '<div class="badge badge-danger">' . trans('messages.status_unknown') . '</div>',
            }
        );
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_ACTIVE => trans('messages.status_active'),
            self::STATUS_INACTIVE => trans('messages.status_inactive'),
        ];
    }
}

