<?php

namespace App\Contracts\Auth;

/**
 * Interface MustVerifyPhone
 * @package App\Contracts\Auth
 */
interface MustVerifyPhone
{
    /**
     * Determine if the user has verified their phone.
     *
     * @return bool
     */
    public function hasVerifiedPhone(): bool;

    /**
     * Mark the given user's phone as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified(): bool;

    /**
     * Send the phone verification notification.
     *
     * @return void
     */
    public function sendPhoneVerificationNotification($message): void;

    /**
     * Get the phone address that should be used for verification.
     *
     * @return string
     */
    public function getPhoneForVerification(): string;

    /**
     * @return void
     */
    public function generatePhoneVerificationCode(): void;
}
