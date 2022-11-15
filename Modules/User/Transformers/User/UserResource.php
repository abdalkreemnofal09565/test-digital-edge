<?php

namespace Modules\User\Transformers\User;

use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
		'identifier' => $this->identifier,
		];
    }
}
