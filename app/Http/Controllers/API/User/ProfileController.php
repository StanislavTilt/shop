<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateUserPhoneRequest;
use App\Http\Requests\User\ValidateChangePhoneRequest;
use App\Http\Requests\User\ValidateDestroyRequest;
use App\Http\Resources\User\ProfileResource;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Services\User\ProfileService;
use App\Http\Requests\User\ProfileAvatarUploadRequest;
use App\Services\VerifyPhoneService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\User\AddressUpdateRequest;
use Illuminate\Support\Facades\Hash;

/**
 * Class ProfileController
 * @package App\Http\Controllers\API\User
 */
class ProfileController extends BaseApiController
{
    /**
     * @var ProfileService
     */
    protected $profileService;
    /**
     * @var VerifyPhoneService
     */
    protected $verifyPhoneService;

    /**
     * ProfileController constructor.
     * @param ProfileService $profileService
     * @param VerifyPhoneService $verifyPhoneService
     */
    public function __construct(ProfileService $profileService, VerifyPhoneService $verifyPhoneService)
    {
        parent::__construct();
        $this->profileService = $profileService;
        $this->verifyPhoneService = $verifyPhoneService;
    }

    /**
     * @return ProfileResource
     */
    public function getUserInfo(): ProfileResource
    {
        return new ProfileResource($this->user);
    }

    /**
     * @param ProfileUpdateRequest $request
     * @return ProfileResource
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $this->profileService->update($this->user, $request);

        if(is_string($user))
        {
            return $this->getErrorResponse($user, 401);
        }

        return new ProfileResource($user);
    }

    /**
     * @param ProfileAvatarUploadRequest $request
     * @return JsonResponse
     */
    public function uploadAvatar(ProfileAvatarUploadRequest $request): JsonResponse
    {
        $this->profileService->uploadAvatar($this->user, $request);
        return $this->getResponse([
            'message' => __('app.The avatar was successfully uploaded.')
        ], 201);
    }

    /**
     * @param AddressUpdateRequest $request
     * @return JsonResponse
     */
    public function updateAddress(AddressUpdateRequest $request): JsonResponse
    {
        $this->profileService->updateAddress($this->user, $request);

        return $this->getResponse([
            'message' => __('app.The address was successfully uploaded.')
        ], 201);
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function requestChangePhone()
    {
        $this->profileService->requestChangePhone($this->user, $this->verifyPhoneService);

        return $this->getResponse([
            'message' => __('app.Phone change request was successfully uploaded.')
        ], 201);
    }

    /**
     * @param ValidateChangePhoneRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function validateChangePhone(ValidateChangePhoneRequest $request)
    {
        $res = $this->profileService->validateChangePhone( $this->user, $request->validated(), $this->verifyPhoneService);

        if (is_string($res)) {
            return $this->getErrorResponse($res);
        }

        return $this->getResponse([
            'message' => __('app.Phone was successfully updated.')
        ], 201);
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function requestDestroy()
    {
        $this->profileService->destroyRequest($this->user, $this->verifyPhoneService);

        return $this->getResponse([
            'message' => __('app.Deletion request successfully sent.')
        ], 201);
    }

    /**
     * @param ValidateDestroyRequest $request
     * @return JsonResponse
     */
    public function validateDestroy(ValidateDestroyRequest $request)
    {
        $res = $this->profileService->validateDestroy( $this->user, $request->validated(), $this->verifyPhoneService);

        if (is_string($res)) {
            return $this->getErrorResponse($res);
        }

        return $this->getResponse([
            'message' => __('app.Account was successfully deleted.')
        ], 201);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $requestData = $request->validated();
        if(!Hash::check($requestData['old_password'],$this->user->password))
        {
            return $this->getErrorResponse(__('app.Current user password incorrect.'), 401);
        }

        $this->user->update(['password' => Hash::make($requestData['new_password'])]);

        return $this->getResponse([
            'message' => __('app.Password was successfully updated.')
        ], 201);
    }
}
