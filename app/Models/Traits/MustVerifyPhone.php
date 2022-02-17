<?php

namespace App\Models\Traits;

use App\Notifications\VerifyPhone;
use Exception;

/**
 * Trait MustVerifyPhone
 * @package App\Models\Traits
 */
trait MustVerifyPhone
{
    /**
     * Determine if the user has verified their phone.
     *
     * @return bool
     */
    public function hasVerifiedPhone(): bool
    {
        return ! is_null($this->phone_verified_at);
    }

    /**
     * Mark the given user's phone as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified(): bool
    {
        return $this->forceFill([
            'phone_verification_code' => null,
            'phone_verification_code_expire' => null,
            'phone_verified_at' => now(),
            'status' => self::STATUS_ACTIVE
        ])->save();
    }

    /**
     * Send the phone verification notification.
     *
     * @param $message
     * @return void
     * @throws Exception
     */
    public function sendPhoneVerificationNotification($message): void
    {
        $this->generatePhoneVerificationCode();
        $this->notify(new VerifyPhone($message));
    }

    /**
     * Get the phone address that should be used for verification.
     *
     * @return string
     */
    public function getPhoneForVerification(): string
    {
        return $this->phone;
    }

    /**
     * @throws Exception
     */
    public function generatePhoneVerificationCode(): void
    {
        $this->phone_verified_at = null;
        $this->phone_verification_code = (string) random_int(10000, 99999);
        $this->phone_verification_code_expire = now()->addMinutes(config('phone.verification_code_lifetime'));
        $this->save();
    }


}
