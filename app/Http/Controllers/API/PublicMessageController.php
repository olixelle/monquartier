<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicMessageResource;
use App\Models\PublicMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PublicMessageController extends Controller
{
    const ITEM_PER_PAGE = 20;

    public function index(Request $request)
    {
        $collection = PublicMessage::with('user')->orderByDesc('created_at')->take(self::ITEM_PER_PAGE);

        if ($request->from) {
            $collection->where('id', '>=', $request->from);
        }

        if ($request->page) {
            $collection->skip(($request->page - 1) * self::ITEM_PER_PAGE);
        }

        return response()->json([
            'success' => true,
            'data' => [
                PublicMessageResource::collection($collection->get())
            ]
        ], 200);
    }


    public function publish(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $msg = new PublicMessage();
        $msg->message = $request->message;
        $msg->neighborhood = 1;
        $msg->owner = $request->user()->id;
        $msg->created_at = Carbon::now();
        $msg->save();

        return response()->json([
            'success' => true,
            'data' => new PublicMessageResource($msg)
        ], 200);
    }
}
