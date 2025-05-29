<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicMessageResource extends JsonResource
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
            'by' => $this->user->name,
            'image' => $imageHelper->getPublicUrl($this->user->image),
            'message' => $this->message,
            'created_at' => $this->created_at,
        ];
    }
}
