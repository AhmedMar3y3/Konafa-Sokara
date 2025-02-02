<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Delegate extends Model
{
    use HasFactory, SoftDeletes, HasImage, HasApiTokens, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'country_code',
        'is_active',
        'email',
        'image',
        'password',
        'code',
        'code_expire',
        'is_verified',
        'admin_code',
    ];

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
        'is_verified' => 'boolean',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function isCodeExpired()
    {
        return $this->code_expire && now()->gt($this->code_expire);
    }


    public function markAsVerified()
    {
        $this->update([
            'is_active' => true,
            'code' => null,
            'code_expire' => null,
        ]);
    }

    public function updatePassword($password)
    {
        $this->update([
            'password' => $password,
            'code' => null,
            'code_expire' => null,
            'is_verified' => false,
        ]);
    }

    public function sendVerificationCode()
    {
        $this->update([
            'code' => '123456',
            'code_expire' => now()->addMinutes(1),
        ]);

        // (new SendVerificationCodeService())->sendCodeToUser($this);
    }

    public function login()
    {
        return $this->createToken('delegate-token')->plainTextToken;
    }

    public function changePassword(string $newPassword): void
    {
        $this->password = $newPassword;
        $this->save();
    }

    public function verifyPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
