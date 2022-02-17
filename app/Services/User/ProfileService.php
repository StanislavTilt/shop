<?php

namespace App\Services\User;

use App\Enums\MessageTemplateKeysEnum;
use App\Events\PhoneVerification;
use App\Models\Order;
use App\Models\OtherServerSetting;
use App\Models\PhoneChangeRequest;
use App\Models\User;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Http\Requests\User\ProfileAvatarUploadRequest;
use App\Models\ValidationRequest;
use App\Services\Helpers\ProfileHelperService;
use App\Services\VerifyPhoneService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\AddressUpdateRequest;

/**
 * Class ProfileService
 * @package App\Services\User
 */
class ProfileService
{

    protected $helperService;

    /**
     * PhoneVerificationController constructor.
     * @param VerifyPhoneService $verifyPhoneService
     * @param ProfileHelperService $helperService
     */
    public function __construct(VerifyPhoneService $verifyPhoneService, ProfileHelperService $helperService)
    {
        $this->verifyPhoneService = $verifyPhoneService;
        $this->helperService = $helperService;
    }

    /**
     * @param User $user
     * @param ProfileUpdateRequest $request
     * @return string
     */
    public function update(User $user, ProfileUpdateRequest $request)
    {
        $requestDataAddress = $request->only([
            'country',
            'city',
            'street',
            'region',
            'flat',
            'postal_code',
            'lat',
            'lng',
        ]);

        if(isset($requestDataAddress['country']) && isset($requestDataAddress['city']))
        {
            $country = $requestDataAddress['country'] == null ? $user->address->country : $requestDataAddress['country'];
            $city = $requestDataAddress['city'] == null ? $user->address->city : $requestDataAddress['city'];

            $res = $this->helperService->validateAddress($country, $city);
            if(is_string($res))
            {
                return $res;
            }


        }

        $user->update([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'has_subscription' => $request->has_subscription
        ]);

        $user->address()->updateOrCreate([
            'user_id' => $user->id
        ], $requestDataAddress);

        return $user->load('address');
    }


    /**
     * @param User $user
     * @param ProfileAvatarUploadRequest $request
     */
    public function uploadAvatar(User $user, ProfileAvatarUploadRequest $request)
    {
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        $path = $request->file('avatar')->store('images/users/' . $user->id);

        $user->update([
            'avatar' => $path
        ]);
    }

    /**
     * @param User $user
     * @param AddressUpdateRequest $request
     */
    public function updateAddress(User $user, AddressUpdateRequest $request)
    {
        $user->address()->updateOrCreate([
            'user_id' => $user->id
        ], $request->only([
            'country',
            'city',
            'street',
            'region',
            'flat',
            'postal_code',
            'lat',
            'lng',
        ]));
    }

    /**
     * @param User $user
     * @param $requestData
     * @param $verifyPhoneService
     * @return void
     * @throws \Exception
     */
    public function requestChangePhone(User $user, $verifyPhoneService)
    {
        $validationRequest = $user->validationRequest;
        if(isset($validationRequest))
        {
            $verifyPhoneService->resend($user->phone);
        }

        $requestLifetime = OtherServerSetting::getSettingValue(OtherServerSetting::VALIDATION_REQUEST_LIFETIME);
        $validationRequest = ValidationRequest::create([
            'user_id' => $user->id,
            'code' => bin2hex(random_bytes(3)),
            'key' => MessageTemplateKeysEnum::CHANGE_PHONE,
            'expired_at' => now()->addSeconds($requestLifetime)->addMinutes(120),
        ]);

        event(new PhoneVerification($user, $validationRequest->code, $validationRequest->key));

    }

    /**
     * @param User $user
     * @param $requestData
     * @param $verifyPhoneService
     * @return
     */
    public function validateChangePhone(User $user, $requestData, $verifyPhoneService)
    {
        $res = $verifyPhoneService->verify(
            $user->phone,
            MessageTemplateKeysEnum::CHANGE_PHONE,
            $requestData['code']
        );

        if (is_string($res)) {
            return $res;
        }

        $res->update(['phone' => $requestData['new_phone']]);
    }

    /**
     * @param User $user
     * @param $verifyPhoneService
     * @throws \Exception
     */
    public function destroyRequest(User $user, $verifyPhoneService)
    {
        $validationRequest = $user->validationRequest;
        if(isset($validationRequest))
        {
            $verifyPhoneService->resend($user->phone);
            return;
        }

        $requestLifetime = OtherServerSetting::getSettingValue(OtherServerSetting::VALIDATION_REQUEST_LIFETIME);
        $validationRequest = ValidationRequest::create([
            'user_id' => $user->id,
            'code' => bin2hex(random_bytes(3)),
            'key' => MessageTemplateKeysEnum::DELETE_ACCOUNT,
            'expired_at' => now()->addSeconds($requestLifetime)->addMinutes(120),
        ]);

        event(new PhoneVerification($user, $validationRequest->code, $validationRequest->key));
    }

    /**
     * @param User $user
     * @param $requestData
     * @param $verifyPhoneService
     * @return mixed
     */
    public function validateDestroy(User $user, $requestData, $verifyPhoneService)
    {
        $res = $verifyPhoneService->verify(
            $user->phone,
            MessageTemplateKeysEnum::DELETE_ACCOUNT,
            $requestData['code']
        );

        if (is_string($res)) {
            return $res;
        }

        $orderIds = $res->orders->pluck('id');
        Order::whereIn('id', $orderIds)->update(['user_id' => null]);

        $res->cart->products()->delete();
        $res->cart()->delete();
        $res->address()->delete();
        $res->restoreRequest()->delete();
        $res->phoneChangeRequest()->delete();
        $res->delete();
    }
}
