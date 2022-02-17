<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MessageTemplateUpdateRequest;
use App\Models\MessageTemplate;
use Illuminate\Http\Request;

/**
 * Class MessageTemplateController
 * @package App\Http\Controllers\Api\admin
 */
class MessageTemplateController extends BaseApiController
{
    /**
     * MessageTemplateController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return MessageTemplate[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return MessageTemplate::all();
    }

    /**
     * @param MessageTemplateUpdateRequest $request
     * @param MessageTemplate $messageTemplate
     * @return MessageTemplate
     */
    public function update(MessageTemplateUpdateRequest $request, MessageTemplate $messageTemplate)
    {
        $requestData = $request->validated();
        $messageTemplate->update($requestData);
        return $messageTemplate;
    }
}
