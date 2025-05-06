<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationMessageResource extends JsonResource
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
            'message' => $this->message,
            'user' => $this->user->name,
            'user_image' => $imageHelper->getPublicUrl($this->user->image),
        ];
    }
}
