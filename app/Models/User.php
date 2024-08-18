<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * User model
 *
 * @property string $role enum ( user , admin , super_admin )
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar',
        'status',
        'market_agreed_at',
        'personal_data_agreed_at',
        'notification_agreed_at',
        'email_verified_at',
        'sms_agreed_at',
        'terms_agreed_at'
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


    protected $dates = [
        'market_agreed_at',
        'personal_data_agreed_at',
        'notification_agreed_at',
        'email_verified_at',
        'sms_agreed_at',
        'terms_agreed_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'market_agreed_at' => 'datetime',
        'personal_data_agreed_at' => 'datetime',
        'notification_agreed_at' => 'datetime',
        'terms_agreed_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function name(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function company(){
        return $this->hasMany(Company::class);
    }

    public function favorites(){
        return $this->belongsToMany(Offer::class, 'favorites', 'user_id', 'job_id')->withTimestamps();
    }

    public function isAdmin(){
        return str_contains($this->role, 'admin');
    }



}
