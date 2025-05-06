<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imageHelper = new \App\Services\Image();

        $subscriptions = \App\Models\Event\Subscription::where('event', $this->id)->with('subscriber')->get();

        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'user' => $this->subscriber->name,
            'user_image' => $imageHelper->getPublicUrl($this->subscriber->image),
        ];
    }
}
