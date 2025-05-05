<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class Offer
{

    public function create($offerData) {

        $offer = new \App\Models\Offer();
        $offer->title = $offerData->title;
        $offer->owner = auth()->user()->id;
        $offer->neighborhood = auth()->user()->neighborhood_id;
        $offer->category = $offerData->category;
        $offer->status = $offerData->status;
        $offer->type = $offerData->type;
        $offer->price = $offerData->price;
        $offer->description = $offerData->description;
        if( $offerData->image) {
            $imageHelper = new \App\Services\Image();
            $offer->image = $imageHelper->saveImage($offerData->image);
        }
        $offer->save();

        \App\Services\Announcement::create(
            $offer->user->name . " a publié une nouvelle offre <" . $offer->title . ">",
            "offer",
            $offer->id,
            $offer->neighborhood,
            $offer->image
        );

        return $offer;
    }


    public function update($offer, $offerData) {

        $offer->title = $offerData->title ?? $offer->title;
        $offer->category = $offerData->category ?? $offer->category;
        $offer->status = $offerData->status ?? $offer->status;
        $offer->type = $offerData->type ?? $offer->type;
        $offer->price = $offerData->price ?? $offer->price;
        $offer->description = $offerData->description ?? $offer->description;
        if( $offerData->image) {
            $imageHelper = new \App\Services\Image();
            $offer->image = $imageHelper->saveImage($offerData->image);
        }
        $offer->save();

        return $offer;
    }

}
