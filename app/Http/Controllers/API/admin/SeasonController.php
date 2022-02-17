<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;

/**
 * Class SeasonController
 * @package App\Http\Controllers\Api\admin
 */
class SeasonController extends BaseApiController
{
    /**
     * SeasonController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->getResponse(Season::all()->toArray());
    }
}
