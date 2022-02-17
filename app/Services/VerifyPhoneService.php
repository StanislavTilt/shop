<?php

namespace App\Services;

use App\Enums\MessageTemplateKeysEnum;
use App\Events\PhoneVerification;
use App\Listeners\PhoneVerificationListener;
use App\Models\MessageTemplate;
use App\Models\User;
use App\Models\ValidationRequest;
use Exception;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class VerifyPhoneService
 * @package App\Services
 */
class VerifyPhoneService
{
    /**
     * @param string $phone
     * @param string $code
     * @param string $device_name
     * @return User|array|Application|Translator|string
     */
    public function verify(string $phone, $type,string $code)
    {
        $user = $this->findUserByPhone($phone);

        $validationRequest = ValidationRequest::where('user_id', $user->id)
            ->where('key', $type)
            ->first();

        if(!$validationRequest)
        {
            return __('app.This confirmation request does not exist');
        }

        if ($validationRequest->expired_at < now()) {
            return __('auth.The confirmation code is expired.');
        }

        if ($code !== $validationRequest->code) {
            return __('auth.Invalid confirmation code.');
        }

        $validationRequest->delete();

        return $user;
    }

    /**
     * @param string $phone
     * @return array|Application|Translator|string|null
     * @throws Exception
     */
    public function resend(string $phone)
    {
        $user = $this->findUserByPhone($phone);

        if ($user->phone_verification_code_expire && $user->phone_verification_code_expire->gt(now())) {
            return __('auth.The confirmation code has already been sent.');
        }

        $validationRequest = $user->validationRequest()->first();

        event(new PhoneVerification($user, $validationRequest->code, $validationRequest->key));
    }

    /**
     * @param $phone
     * @return User
     */
    private function findUserByPhone($phone): User
    {
        return User::where('phone', $phone)->notBanned()->first();
    }
}
