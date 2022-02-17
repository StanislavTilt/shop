<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateVendorRequest;
use App\Http\Requests\Admin\SearchVendorRequest;
use App\Http\Requests\Admin\UpdateVendorRequest;
use App\Http\Resources\Admin\VendorResource;
use App\Models\Tag;
use App\Models\Vendor;
use Illuminate\Http\Request;

/**
 * Class VendorController
 * @package App\Http\Controllers\Api\Admin
 */
class VendorController extends BaseApiController
{
    /**
     * VendorController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $vendors = Vendor::all();
        return VendorResource::collection($vendors);
    }

    /**
     * @param SearchVendorRequest $request
     * @return mixed
     */
    public function search(SearchVendorRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');
        $vendors = Vendor::orderBy($sortKey, $sortMethod);

        if(isset($request->id))
        {
            $vendors = $vendors->where('id', 'like' , '%'.$request->id.'%');
        }
        if(isset($request->name))
        {
            $vendors = $vendors->where('name', 'like' , '%'.$request->name.'%');
        }
        if(isset($request->is_active))
        {
            $vendors = $vendors->where('is_active', $request->is_active);
        }

        return $vendors->paginate(10);
    }

    /**
     * @param CreateVendorRequest $request
     * @return mixed
     */
    public function create(CreateVendorRequest $request)
    {
        $requestData = $request->validated();
        $vendor = Vendor::create($requestData);
        return $vendor;
    }

    /**
     * @param Vendor $vendor
     * @return Vendor
     */
    public function show(Vendor $vendor)
    {
        return $vendor;
    }

    /**
     * @param UpdateVendorRequest $request
     * @param Vendor $vendor
     * @return Vendor
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $requestData = $request->validated();
        $vendor->update($requestData);
        return $vendor;
    }

}
