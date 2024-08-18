<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'address', //remove
        'gender', //remove
        'dob', //remove
        'experience',
        'phone',
        'bio',
        'cover_letter', // link do pdf ?!
        'resume', // link to pdf ?!
        'avatar',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $dates = [
//        'market_agreed_at',
//        'personal_data_agreed_at',
//        'notification_agreed_at',
//        'additional_email_verified_at',
//        'email_verified_at',
//        'sms_agreed_at',
//        'terms_agreed_at'
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
//        'email_verify_is_pending' => 'boolean',
//        'is_active' => 'boolean'
    ];

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
