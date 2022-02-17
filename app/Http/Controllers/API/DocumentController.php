<?php

namespace App\Http\Controllers\API;

use App\Models\Document;
use App\Http\Resources\DocumentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class DocumentController
 * @package App\Http\Controllers\API
 */
class DocumentController extends BaseApiController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        return DocumentResource::collection(Document::all());
    }

    /**
     * Display a listing of the resource.
     *
     * @param Document $document
     * @return DocumentResource
     */
    public function getBySlug(Document $document): DocumentResource
    {
        return new DocumentResource($document);
    }
}
