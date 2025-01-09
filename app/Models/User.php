<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'country_code',
        'email',
        'birth_date',
        'password',
        'is_active',
        'completed_info',
        'is_notify',
        'owned_referral_code',
        'used_referral_code',
        'lat',
        'lng',
        'map_desc',
        'title',
        'code',
        'code_expire',
        'is_verified',
        'points',
        'rated_app',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'code_expire' => 'datetime',
        'is_active' => 'boolean',
        'completed_info' => 'boolean',
        'is_notify' => 'boolean',
        'is_verified' => 'boolean',
        'rated_app' => 'boolean',
    ];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public static function generateReferralCode()
    {
        return Str::random(8);
    }

    public function isCodeExpired()
    {
        return $this->code_expire && now()->gt($this->code_expire);
    }


    public function updateLocation(string $lat, string $lng, string $map_desc): void
    {
        $this->update([
            'lat' => $lat,
            'lng' => $lng,
            'map_desc' => $map_desc,
            'completed_info' => true,
        ]);
    }

    public function markAsVerified()
    {
        $this->update([
            'is_verified' => true,
            'is_active' => true,
            'code' => null,
            'code_expire' => null,
        ]);
    }

    public function resendVerificationCode()
    {
        $this->update([
            'code' => '123456',
            'code_expire' => now()->addMinutes(1),
        ]);
    }
}
