<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imageHelper = new \App\Services\Image();

        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'description' => $this->description,
            'neighborhood_id' => $this->neighborhood_id,
            'name' => $this->name,
            'image' => $imageHelper->getPublicUrl($this->image),
        ];
    }
}
