<?php

namespace App\Http\Controllers\API\auth;

use App\Enums\AdminStatusesEnum;
use App\Enums\UserTypesEnum;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminLoginController
 * @package App\Http\Controllers\api\auth
 */
class AdminLoginController extends BaseApiController
{
    /**
     * AdminLoginController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param AdminLoginRequest $request
     * @return AdminResource|\Illuminate\Http\JsonResponse
     */
    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('admin')->attempt($credentials)) {
            return $this->getErrorResponse(__('auth.failed'), 401);
        }

        $user = Auth::guard('admin')->user();

        if($user->status != AdminStatusesEnum::ACTIVE)
        {
            return $this->getErrorResponse(__('auth.admin_non_active'), 401);
        }

        if(!in_array($user->role,UserTypesEnum::ADMIN_ROLES))
        {
            return $this->getErrorResponse(__('auth.non_admin'), 401);
        }

        return (new AdminResource($user))->additional([
            'token' => $user->createToken($request->email)->plainTextToken
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->user->currentAccessToken()->delete();

        return $this->getSuccessResponse(204);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken()
    {
        $user = $this->user;

        $currentToken = $user->currentAccessToken();
        $newToken = $user->createToken($user->nickname)->plainTextToken;
        $currentToken->delete();

        return $this->getResponse([
            'token' => $newToken
        ]);
    }
}
