<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Trait BaseRestTrait
 * @package App\Traits
 */
trait BaseRestTrait
{
    /**
     * Get the JSON response.
     *
     * @param array $data
     * @param int $httpStatus
     *
     * @return JsonResponse
     */
    public function getResponse(array $data, int $httpStatus = 200): JsonResponse
    {
        return Response::json($data, $httpStatus);
    }

    /**
     * @param string $message
     * @param int $httpStatus
     * @param array $errors
     * @return JsonResponse
     */
    public function getErrorResponse(string $message, int $httpStatus = 400, array $errors = []): JsonResponse
    {
        return $this->getResponse($this->answerGenerate($message, $errors), $httpStatus);
    }

    /**
     * @param int $httpStatus = 204
     * @return JsonResponse
     */
    public function getSuccessResponse(int $httpStatus = 204): JsonResponse
    {
        return $this->getResponse(['message' => 'success'], $httpStatus);
    }

    /**
     * Generate  answer for unist
     * @param string $message
     * @param $errors
     * @return array
     */
    public function answerGenerate(string $message, $errors): array
    {
        if (empty($errors)) {
            $errors = ['error' => [$message]];
        }
        return [
            "message" => $message,
            "errors" => $errors
        ];
    }
}
