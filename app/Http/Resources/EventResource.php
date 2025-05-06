<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'user' => $this->user->name,
            'user_image' => $imageHelper->getPublicUrl($this->user->image),
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'starts_at' => $this->starts_at,
            'image' => $imageHelper->getPublicUrl($this->image),
            'created_at' => $this->created_at,
            'subscriptions_count' => $this->subscription_count
        ];
    }
}
