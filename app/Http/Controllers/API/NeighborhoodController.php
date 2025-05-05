<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Neighborhood;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AnnouncementResource;
use App\Http\Resources\UserResource;

class NeighborhoodController extends Controller
{
    public function people(Request $request) {

        $collection = User::where('neighborhood_id', '=', $request->user()->neighborhood_id);
        $collection->orderByDesc('created_at');

        return response()->json([
            'success' => true,
            'data' => [
                UserResource::collection( $collection->get())
            ]
        ], 200);

    }

    public function announcement(Request $request) {

        $collection = Announcement::where('neighborhood', '=', $request->user()->neighborhood_id);

        if ($request->from) {
            $collection->where('id', '>=', $request->from);
        }

        $collection->orderByDesc('created_at');

        return response()->json([
            'success' => true,
            'data' => [
                AnnouncementResource::collection( $collection->get())
            ]
        ], 200);

    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                Neighborhood::get()
            ]
        ], 200);
    }
}
