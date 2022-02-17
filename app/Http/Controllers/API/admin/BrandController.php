<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\CreateBrandRequest;
use App\Http\Requests\Admin\SearchBrandsRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;

/**
 * Class BrandController
 * @package App\Http\Controllers\Api\admin
 */
class BrandController extends BaseApiController
{
    /**
     * @param SearchBrandsRequest $request
     * @return mixed
     */
    public function search(SearchBrandsRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');
        $brands = Brand::orderBy($sortKey, $sortMethod);

        if(isset($request->id))
        {
            $brands = $brands->where('id', 'like' , '%'.$request->id.'%');
        }
        if(isset($request->name))
        {
            $brands = $brands->where('name', 'like' , '%'.$request->name.'%');
        }
        if(isset($request->is_active))
        {
            $brands = $brands->where('is_active', $request->is_active);
        }

        return $brands->paginate(10);
    }

    /**
     * @param CreateBrandRequest $request
     * @return mixed
     */
    public function create(CreateBrandRequest $request)
    {
        $requestData = $request->validated();
        $brand = Brand::create($requestData);
        return $brand;
    }

    /**
     * @param Brand $brand
     * @return Brand
     */
    public function show(Brand $brand)
    {
        return $brand;
    }

    /**
     * @param UpdateBrandRequest $request
     * @param Brand $brand
     * @return Brand
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $requestData = $request->validated();
        $brand->update($requestData);
        return $brand;
    }

}
