<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'user_image' => $this->user->image,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->relatedCategory->title,
            'type' => $this->type,
            'status' => $this->status,
            'price' => $this->price,
            'created_at' => $this->created_at,
        ];
    }
}
