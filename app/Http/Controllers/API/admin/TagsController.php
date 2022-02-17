<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateTagsRequest;
use App\Http\Requests\Admin\SearchTagsRequest;
use App\Http\Requests\Admin\UpdateTagRequest;
use App\Models\ProductTag;
use App\Models\Tag;

/**
 * Class TagsController
 * @package App\Http\Controllers\Api\admin
 */
class TagsController extends BaseApiController
{
    /**
     * @param SearchTagsRequest $request
     * @return mixed
     */
    public function search(SearchTagsRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');
        $tags = Tag::orderBy($sortKey, $sortMethod);

        if(isset($request->id))
        {
            $tags = $tags->where('id', 'like' , '%'.$request->id.'%');
        }
        if(isset($request->title))
        {
            $tags = $tags->where('title', 'like' , '%'.$request->title.'%');
        }

        return $tags->paginate(10);
    }

    /**
     * @param CreateTagsRequest $request
     * @return mixed
     */
    public function create(CreateTagsRequest $request)
    {
        $requestData = $request->validated();
        $tag = Tag::create($requestData);
        return $tag;
    }

    /**
     * @param Tag $tag
     * @return Tag
     */
    public function show(Tag $tag)
    {
        return $tag;
    }

    /**
     * @param UpdateTagRequest $request
     * @param Tag $tag
     * @return Tag
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $requestData = $request->validated();
        $tag->update($requestData);
        return $tag;
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tag $tag)
    {
        ProductTag::where('tag_id', $tag->id)
            ->delete();
        $tag->delete();
        return $this->getSuccessResponse(200);
    }
}
