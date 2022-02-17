<?php

namespace App\Http\Controllers\API\Auth;

use App\Services\Auth\RegisterService;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\BaseApiController;
use DomainException;

/**
 * Class RegisterController
 * @package App\Http\Controllers\API\Auth
 */
class RegisterController extends BaseApiController
{
    /**
     * @var RegisterService
     */
    private $registerService;

    /**
     * RegisterController constructor.
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        parent::__construct();
        $this->registerService = $registerService;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $result = $this->registerService->register($request);

        if (is_string($result)) {
            return $this->getErrorResponse($result, 500);
        }

        return $this->getResponse([
            'message' => __('auth.The confirmation code has been sent to the phone number')
        ]);
    }
}
