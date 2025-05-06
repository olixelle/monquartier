<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class Event
{

    public function create($eventData) {

        $event = new \App\Models\Event();
        $event->title = $eventData->title;
        $event->owner = auth()->user()->id;
        $event->neighborhood = auth()->user()->neighborhood_id;
        $event->description = $eventData->description;
        $event->location = $eventData->location;
        $event->starts_at = $eventData->starts_at;
        $event->ends_at = $eventData->ends_at;
        $event->duration = $eventData->duration;
        $event->requires_reservation = $eventData->requires_reservation ?? 0;
        $event->seats_total = $eventData->seats_total;
        if( $eventData->image) {
            $imageHelper = new \App\Services\Image();
            $event->image = $imageHelper->saveImage($eventData->image);
        }
        $event->save();

        \App\Services\Announcement::create(
            $event->user->name . " a publié une nouvel évènement <" . $event->title . ">",
            "event",
            $event->id,
            $event->neighborhood,
            $event->image
        );

        return $event;
    }


    public function update($event, $eventData) {

        $event->title = $eventData->title ?? $event->title;
        $event->description = $eventData->description ?? $event->description;
        $event->location = $eventData->location ?? $event->location;
        if($eventData->image) {
            $imageHelper = new \App\Services\Image();
            $event->image = $imageHelper->saveImage($eventData->image);
        }
        $event->save();

        return $event;
    }

    public function subscribe($event) {

        //check if there is already a subscription
        $subscription = \App\Models\Event\Subscription::where('event', $event->id)->where('user', auth()->user()->id)->first();
        if ($subscription && $subscription->id > 0)
            return $subscription;

        $subscription = new \App\Models\Event\Subscription();
        $subscription->event = $event->id;
        $subscription->user = auth()->user()->id;
        $subscription->save();

        $this->updateSubscriberCount($event);

        return $subscription;
    }

    public function unsubscribe($event) {

        $subscription = \App\Models\Event\Subscription::where('event', $event->id)->where('user', auth()->user()->id)->first();
        if ($subscription && $subscription->id > 0)
        {
            $subscription->delete();
            $this->updateSubscriberCount($event);
        }
    }

    public function updateSubscriberCount($event) {
        $count = \App\Models\Event\Subscription::where('event', '=', $event->id)->count();
        $event->subscription_count = $count;
        $event->save();

        return $event;
    }

    public function addMessage($event, $messageData) {

        $message = new \App\Models\Event\Message();

        $message->event = $event->id;
        $message->message = $messageData->message;
        $message->owner = auth()->user()->id;
        $message->save();

        return $message;
    }

}
