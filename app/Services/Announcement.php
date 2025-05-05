<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class Announcement
{

    public static function create($title, $relatedTo, $relatedId, $neighborhood, $image) {

        $announcement = new \App\Models\Announcement();
        $announcement->title = $title;
        $announcement->related_to = $relatedTo;
        $announcement->related_id = $relatedId;
        $announcement->neighborhood = $neighborhood;
        $announcement->image = $image;
        $announcement->save();

        return $announcement;
    }


}
