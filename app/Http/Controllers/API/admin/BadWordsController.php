<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateBadWordRequest;
use App\Http\Requests\Admin\UpdateBadWordRequest;
use App\Http\Resources\Admin\BadWordsResource;
use App\Models\BadWord;
use Illuminate\Http\Request;

/**
 * Class BadWordsController
 * @package App\Http\Controllers\API\admin
 */
class BadWordsController extends BaseApiController
{
    /**
     * BadWordsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param CreateBadWordRequest $request
     * @return BadWordsResource
     */
    public function create(CreateBadWordRequest $request)
    {
        $requestData = $request->validated();
        $badWord = BadWord::create($requestData);
        return BadWordsResource::make($badWord);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return BadWordsResource::collection(BadWord::all());
    }

    /**
     * @param $id
     * @return BadWordsResource
     */
    public function show($id)
    {
        $badWord = BadWord::findOrFail($id);
        return BadWordsResource::make($badWord);
    }

    /**
     * @param UpdateBadWordRequest $request
     * @param $id
     * @return BadWordsResource
     */
    public function update(UpdateBadWordRequest $request, $id)
    {
        $requestData = $request->validated();
        $badWord = BadWord::findOrFail($id);
        $badWord->update($requestData);
        return BadWordsResource::make($badWord);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $badWord = BadWord::findOrFail($id);
        $badWord->delete();
    }
}
