<?php

namespace App\Http\Controllers\API\Auth;

use App\Enums\MessageTemplateKeysEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyPhoneRequest;
use App\Models\User;
use App\Services\VerifyPhoneService;
use Illuminate\Http\JsonResponse;
use Throwable;
use App\Http\Requests\PhoneRequest;
use Exception;
use App\Http\Controllers\API\BaseApiController;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\ProfileResource;

/**
 * Class PhoneVerificationController
 * @package App\Http\Controllers\API\Auth
 */
class PhoneVerificationController extends BaseApiController
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
     * @param VerifyPhoneRequest $request
     * @return JsonResponse|ProfileResource
     * @throws Throwable
     */
    public function verify(VerifyPhoneRequest $request)
    {
        $res = $this->verifyPhoneService->verify(
            $request->phone,
            MessageTemplateKeysEnum::REGISTER,
            $request->code
        );

        if (is_string($res)) {
            return $this->getErrorResponse($res);
        }

        if ($res->phone_verified_at) {
            return __('auth.The phone number has already been confirmed.');
        }

        $res->markPhoneAsVerified();

        return (new ProfileResource($res))->additional([
            'token' => $res->createToken($request->phone)->plainTextToken
        ]);
    }

    /**
     * @param PhoneRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function resend(PhoneRequest $request): JsonResponse
    {
        $result = $this->verifyPhoneService->resend($request->phone);

        if (is_string($result)) {
            return $this->getErrorResponse($result, 403);
        }

        return $this->getResponse([
            'message' => __('auth.The confirmation code has been sent to the phone number')
        ]);
    }

    /**
     * @param PhoneRequest $request
     * @return JsonResponse
     */
    public function getVerificationCode(PhoneRequest $request): JsonResponse
    {
        $user = User::where('phone', $request->phone)->notBanned()
            ->with('validationRequest')
            ->first();

        return $this->getResponse([
            'code' => $user->validationRequest->code
        ]);
    }
}
