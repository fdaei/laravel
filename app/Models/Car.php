<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    const TYPE_SUV = 1;
    const TYPE_SEDAN = 2;
    const TYPE_TRUCK = 3;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const SERIES_FIRST = 1;
    const SERIES_SECOND = 2;
    const SERIES_THIRD = 3;

    protected $fillable = [
        'make',
        'model',
        'color',
        'type',
        'additional_data',
        'status',
        'series',
    ];


    protected $casts = [
        'additional_data' => 'array',
        'type' => 'integer',
        'series' => 'integer',
    ];

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => match ($value) {
                self::TYPE_SUV => trans('messages.type_suv'),
                self::TYPE_SEDAN => trans('messages.type_sedan'),
                self::TYPE_TRUCK => trans('messages.type_truck'),
                default => trans('messages.type_unknown'),
            }
        );
    }

    protected function GetType(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => match ($attributes['type']) {
                self::TYPE_SUV => '<div class="badge badge-info">' . trans('messages.type_suv') . '</div>',
                self::TYPE_SEDAN => '<div class="badge badge-info">' . trans('messages.type_sedan') . '</div>',
                self::TYPE_TRUCK => '<div class="badge badge-info">' . trans('messages.type_truck') . '</div>',
                default => '<div class="badge badge-info">' . trans('messages.type_unknown') . '</div>',
            }
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => match ($value) {
                self::STATUS_ACTIVE => trans('messages.status_active'),
                self::STATUS_INACTIVE => trans('messages.status_inactive'),
                default => trans('messages.status_unknown'),
            }
        );
    }

    protected function GetStatus(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => match ($attributes['status']) {
                self::STATUS_ACTIVE => '<div class="badge badge-success">' . trans('messages.status_active') . '</div>',
                self::STATUS_INACTIVE => '<div class="badge badge-secondary">' . trans('messages.status_inactive') . '</div>',
                default => '<div class="badge badge-danger">' . trans('messages.status_unknown') . '</div>',
            }
        );
    }


    protected function series(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => match ($value) {
                self::SERIES_FIRST => trans('messages.series_first'),
                self::SERIES_SECOND => trans('messages.series_second'),
                self::SERIES_THIRD => trans('messages.series_third'),
                default => trans('messages.series_unknown'),
            }
        );
    }


    public static function typeOptions(): array
    {
        return [
            self::TYPE_SUV => trans('messages.type_suv'),
            self::TYPE_SEDAN => trans('messages.type_sedan'),
            self::TYPE_TRUCK => trans('messages.type_truck'),
        ];
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_ACTIVE => trans('messages.status_active'),
            self::STATUS_INACTIVE => trans('messages.status_inactive'),
        ];
    }

    public static function seriesOptions(): array
    {
        return [
            self::SERIES_FIRST => trans('messages.series_first'),
            self::SERIES_SECOND => trans('messages.series_second'),
            self::SERIES_THIRD => trans('messages.series_third'),
        ];
    }
}
