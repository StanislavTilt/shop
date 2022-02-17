<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateStoreforntRequest;
use App\Http\Requests\Admin\UpdateStoreforntRequest;
use App\Http\Resources\Admin\StorefrontResource;
use App\Models\ProductStorefront;
use App\Models\Storefront;
use App\Services\FileUpload;
use Illuminate\Http\Request;

/**
 * Class StorefrontsController
 * @package App\Http\Controllers\Api\admin
 */
class StorefrontsController extends BaseApiController
{

    /**
     * @var FileUpload
     */
    protected $fileUploadService;

    /**
     * CategoryController constructor.
     * @param FileUpload $service
     */
    public function __construct(FileUpload $service)
    {
        parent::__construct();
        $this->fileUploadService = $service;
        $this->fileUploadService->baseFolder = 'storefronts_icons';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StorefrontResource::collection(Storefront::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateStoreforntRequest $request
     * @return
     */
    public function create(CreateStoreforntRequest $request)
    {
        $requestData = $request->validated();
        $requestData['changeable'] = true;
        $requestData['cover'] = $this->fileUploadService->saveFile($request, 'cover');
        $storefront = Storefront::create($requestData);
        return StorefrontResource::make($storefront);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return StorefrontResource
     */
    public function show($id)
    {
        $storefront = Storefront::findOrFail($id);
        return StorefrontResource::make($storefront);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStoreforntRequest $request
     * @param  int $id
     * @return
     */
    public function update(UpdateStoreforntRequest $request, $id)
    {
        $requestData = $request->validated();
        $storefront = Storefront::findOrFail($id);
        if($storefront->changeable)
        {
            $storefront->update($requestData);
        }
        return StorefrontResource::make($storefront);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        $storefront = Storefront::findOrFail($id);
        if($storefront->changeable)
        {
            ProductStorefront::where('storefront_id',$storefront->id)
                ->delete();
            $storefront->delete($id);
        }
    }
}
