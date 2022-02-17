<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use App\Services\FileUpload;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers\api\admin
 */
class CategoryController extends BaseApiController
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
        $this->fileUploadService->baseFolder = 'category_icons';
    }

    /**
     * @param CreateCategoryRequest $request
     * @return CategoryResource
     */
    public function create(CreateCategoryRequest $request)
    {
        $requestData = $request->validated();
        $requestData['icon'] = $this->fileUploadService->saveFile($request, 'icon', 'save', null);

        $category = Category::create($requestData);

        return CategoryResource::make($category);
    }

    /**
     * @param $category_id
     * @return CategoryResource
     */
    public function show($category_id)
    {
        $category = Category::findOrFail($category_id);

        return CategoryResource::make($category);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param $category_id
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request, $category_id)
    {
        $requestData = $request->validated();
        $category = Category::findOrFail($category_id);

        $oldImage = $category->icon;
        if(isset($requestData['icon']))
        {
            $requestData['icon'] = $this->fileUploadService->saveFile($request, 'icon', 'update', $oldImage);
        }

        $category->update($requestData);

        return CategoryResource::make($category);
    }

    /**
     * @param $category_id
     */
    public function destroy($category_id)
    {
        $category = Category::where('id', $category_id)
            ->with(['children', 'products'])
            ->firstOrFail();

        if (count($category->children) == 0 && count($category->products) == 0)
        {
            $oldImage = $category->icon;
            $this->fileUploadService->saveFile(null, 'icon', 'delete', $oldImage);
            $category->delete();
        }
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAll()
    {
        $categories = Category::all()->load(['children','products']);

        return CategoryResource::collection($categories);
    }
}
