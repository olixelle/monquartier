<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\ConversationMessageResource;
use App\Models\Conversation;
use App\Models\Conversation\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    const ITEM_PER_PAGE = 20;

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'with' => 'required|integer|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $service = new \App\Services\Conversation();
            $conversation = $service->createConversation($request);

            return response()->json([
                'success' => true,
                'message' => 'Conversation created',
                'date' => new ConversationResource($conversation)
            ], 200);
        }
        catch(\Exception $ex)
        {

            return response()->json([
                'success' => true,
                'message' => $ex->getMessage()
            ], 400);
        }
    }

    public function index(Request $request)
    {
        try {
            $collection = Conversation::with('fromUser')->with('toUser')->orderByDesc('updated_at')->take(self::ITEM_PER_PAGE);
            $collection->where(function ($query) {
                $query->where('from', '=', auth()->user()->id)
                    ->orWhere('to', '=', auth()->user()->id);
            });

            if ($request->page) {
                $collection->skip(($request->page - 1) * self::ITEM_PER_PAGE);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    ConversationResource::collection($collection->get())
                ]
            ], 200);

        }
        catch(\Exception $ex) {

            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);
        }

    }

    public function getMessages($id, Request $request)
    {
        try {
            $collection = Message::where('conversation', $id)->with('user')->orderByDesc('created_at')->take(self::ITEM_PER_PAGE);

            if ($request->page) {
                $collection->skip(($request->page - 1) * self::ITEM_PER_PAGE);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    ConversationMessageResource::collection($collection->get())
                ]
            ], 200);

        }
        catch(\Exception $ex) {

            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);
        }
    }


    public function addMessage($id, Request $request)
    {
        try {
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

            $conversation = Conversation::findOrFail($id);
            $service = new \App\Services\Conversation();
            $service->addMessage($conversation, $request);

            return response()->json([
                'success' => true,
                'message' => 'Message added to conversation'
            ], 200);
        }
        catch(\Exception $ex)
        {

            return response()->json([
                'success' => true,
                'message' => $ex->getMessage()
            ], 400);
        }


    }
}
