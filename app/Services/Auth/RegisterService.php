<?php

namespace App\Services\Auth;

use App\Enums\MessageTemplateKeysEnum;
use App\Events\PhoneVerification;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\MessageTemplate;
use App\Models\OtherServerSetting;
use App\Models\User;
use App\Models\ValidationRequest;
use App\Notifications\VerifyPhone;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

/**
 * Class RegisterService
 * @package App\Services\Auth
 */
class RegisterService
{
    /**
     * @param RegisterRequest $request
     * @return string|null
     * @throws \Exception
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'status' => User::STATUS_NOT_VERIFIED,
            'has_subscription' => $request->has_subscription,
            'device_key' => $request->device_key,
        ]);

        if (!$user) {
            return __('auth.An error occurred during registration. Try again later!');
        }

        $requestLifetime = OtherServerSetting::getSettingValue(OtherServerSetting::VALIDATION_REQUEST_LIFETIME);
        $validationRequest = ValidationRequest::create([
            'user_id' => $user->id,
            'code' => bin2hex(random_bytes(3)),
            'additional_parameters' => [],
            'key' => MessageTemplateKeysEnum::REGISTER,
            'expired_at' => now()->addSeconds($requestLifetime)->addMinutes(120),//TODO add Minutes
        ]);

        event(new PhoneVerification($user, $validationRequest->code, $validationRequest->key));
    }
}
