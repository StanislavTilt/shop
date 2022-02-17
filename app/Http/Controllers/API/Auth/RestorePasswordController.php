<?php

namespace App\Http\Controllers\API\Auth;

use App\Enums\MessageTemplateKeysEnum;
use App\Enums\UserTypesEnum;
use App\Events\CreatedRestoreRequestEvent;
use App\Events\PhoneVerification;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Auth\EndRecoveryRequest;
use App\Http\Requests\Auth\RestorePasswordRequest;
use App\Http\Resources\User\ProfileResource;
use App\Models\OtherServerSetting;
use App\Models\RestoreRequest;
use App\Models\User;
use App\Models\ValidationRequest;
use App\Services\VerifyPhoneService;
use Illuminate\Support\Facades\Hash;

/**
 * Class RestorePasswordController
 * @package App\Http\Controllers\Api\Auth
 */
class RestorePasswordController extends BaseApiController
{
    /**
     * @var VerifyPhoneService
     */
    private $verifyPhoneService;

    /**
     * PhoneVerificationController constructor.
     * @param VerifyPhoneService $verifyPhoneService
     */
    public function __construct(VerifyPhoneService $verifyPhoneService)
    {
        parent::__construct();
        $this->verifyPhoneService = $verifyPhoneService;
    }

    /**
     * @param RestorePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function requestRestore(RestorePasswordRequest $request)
    {
        $credentials = $request->only('phone');

        $user = User::where('phone',$credentials['phone'])
            ->firstOrFail();

        if(in_array($user->role,UserTypesEnum::ADMIN_ROLES))
        {
            return $this->getErrorResponse(__('auth.not_for_admin'), 401);
        }

        if($user->validationRequest)
        {
            return $this->getErrorResponse(__('app.active_validation_request'), 401);
        }

        $requestLifetime = OtherServerSetting::getSettingValue(OtherServerSetting::VALIDATION_REQUEST_LIFETIME);
        $validationRequest = ValidationRequest::create([
            'user_id' => $user->id,
            'code' => bin2hex(random_bytes(3)),
            'additional_parameters' => [],
            'key' => MessageTemplateKeysEnum::RECOVER_PASSWORD,
            'expired_at' => now()->addSeconds($requestLifetime)->addMinutes(120),
        ]);

        event(new PhoneVerification($user, $validationRequest->code, $validationRequest->key));
    }

    /**
     * @param EndRecoveryRequest $request
     * @return ProfileResource
     */
    public function restore(EndRecoveryRequest $request)
    {
        $requestData = $request->validated();

        $user = $this->verifyPhoneService->verify(
            $request->phone,
            MessageTemplateKeysEnum::RECOVER_PASSWORD,
            $request->code
        );

        if (is_string($user)) {
            return $this->getErrorResponse($user);
        }

        $user->update(['password' => Hash::make($requestData['password'])]);

        return (new ProfileResource($user))->additional([
            'token' => $user->createToken($request->phone)->plainTextToken
        ]);
    }
}
