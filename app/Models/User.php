<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Contracts\Auth\MustVerifyPhone as MustVerifyPhoneContract;
use App\Models\Traits\MustVerifyPhone;
use App\Notifications\ResetPassword;
use Illuminate\Support\Carbon;
use Exception;

/**
 * Class User
 * @package App\Models
 *
 * @param integer $id
 * @param string $name
 * @param string $avatar
 * @param string $nickname
 * @param string $phone
 * @param integer $phone_verification_code
 * @param Carbon $phone_verification_code_expire
 * @param Carbon $phone_verified_at
 * @param string $email
 * @param string $password
 * @param string $remember_token
 * @param integer $status
 */
class User extends Authenticatable implements MustVerifyPhoneContract
{
    use HasApiTokens, HasFactory, Notifiable, MustVerifyPhone;

    /**
     *
     */
    const STATUS_ACTIVE = 1;
    /**
     *
     */
    const STATUS_NOT_VERIFIED = 2;
    /**
     *
     */
    const STATUS_BANNED = 3;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'phone_verification_code',
        'phone_verification_code_expire',
        'phone_verified_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'avatar',
        'phone',
        'phone_verification_code',
        'phone_verification_code_expire',
        'phone_verified_at',
        'email',
        'password',
        'status',
        'mute',
        'discount',
        'device_key',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verification_code_expire' => 'datetime',
        'phone_verified_at' => 'datetime',
        'has_subscription' => 'boolean',
    ];

    /**
     * @param $notification
     * @return mixed|string
     */
    public function routeNotificationForSmsRu($notification)
    {
        return $this->phone;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotBanned($query)
    {
        return $query->where('status', '<>', User::STATUS_BANNED);
    }

    /**
     * @throws Exception
     */
    public function sendPasswordResetNotification($token)
    {
        $this->generatePhoneVerificationCode();
        $this->notify(new ResetPassword());
    }

    /**
     * @return HasOne
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @return HasOne
     */
    public function restoreRequest()
    {
        return $this->hasOne(RestoreRequest::class,'user_id');
    }

    /**
     * @return HasOne
     */
    public function phoneChangeRequest()
    {
        return $this->hasOne(PhoneChangeRequest::class,'user_id');
    }

    /**
     * @return HasOne
     */
    public function validationRequest()
    {
        return $this->hasOne(ValidationRequest::class);
    }
}
