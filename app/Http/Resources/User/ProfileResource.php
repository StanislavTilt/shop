<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\User;

/** @mixin User */
class ProfileResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar ? asset($this->avatar) : null,
            'nickname' => $this->nickname,
            'phone' => $this->phone,
            'email' => $this->email,

            'address' => new AddressResource($this->address)
        ];
    }
}
