<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens; // Include this if you're using Passport for OAuth2

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile',
        'first_name',
        'last_name',
        'address',
        'password',
        'gender',
        'created_by',
        'updated_by',
        'avatar',
        'status',
        'email',
        'national_code',
        'birthdate',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
        'password' => 'hashed', // Laravel 10+ supports hashed casting
    ];

    /**
     * Get the user that created this user.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that last updated this user.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
