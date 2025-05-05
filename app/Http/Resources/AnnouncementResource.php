<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
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
            'title' => $this->title,
            'related_to' => $this->related_to,
            'related_id' => $this->related_id,
            'image' => $imageHelper->getPublicUrl($this->image),
        ];
    }
}
