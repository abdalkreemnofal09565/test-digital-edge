<?php

namespace Modules\Product\Transformers\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\User\UserResource;


class ProductResource extends JsonResource
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
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'description' => $this->description,
            'user' => new UserResource($this->whenLoaded('user')),
		];
    }
}
