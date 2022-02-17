<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateColorRequest;
use App\Http\Requests\Admin\SearchColorRequest;
use App\Http\Requests\Admin\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

/**
 * Class ColorsController
 * @package App\Http\Controllers\Api\admin
 */
class ColorsController extends BaseApiController
{
    /**
     * @param SearchColorRequest $request
     * @return mixed
     */
    public function search(SearchColorRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');
        $tags = Color::orderBy($sortKey, $sortMethod);

        if(isset($request->name))
        {
            $tags = $tags->where('name', 'like' , '%'.$request->name.'%');
        }

        return $tags->paginate(10);
    }

    /**
     * @param CreateColorRequest $request
     * @return mixed
     */
    public function create(CreateColorRequest $request)
    {
        $requestData = $request->validated();
        $color = Color::create($requestData);
        return $color;
    }

    /**
     * @param Color $color
     * @return Color
     */
    public function show(Color $color)
    {
        return $color;
    }

    /**
     * @param UpdateColorRequest $request
     * @param Color $color
     * @return Color
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        $requestData = $request->validated();
        $color->update($requestData);
        return $color;
    }
}
