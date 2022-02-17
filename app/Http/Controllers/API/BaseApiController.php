<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\BaseRestTrait;

/**
 * Class BaseApiController
 * @package App\Http\Controllers\Api
 */
class BaseApiController extends Controller
{
    use BaseRestTrait;

    /**
     * @var User|null
     */
    protected $user;

    /**
     * BaseApiController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth('sanctum')->user();
            return $next($request);
        });
    }
}
