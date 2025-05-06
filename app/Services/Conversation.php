<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class Conversation
{
    public function createConversation($request)
    {
        $conversation = new \App\Models\Conversation();
        $conversation->from = auth()->user()->id;
        $conversation->to = $request->with;
        $conversation->messages_count = 0;
        $conversation->save();

        return $conversation;
    }

    public function addMessage($conversation, $messageData) {

        $message = new \App\Models\Conversation\Message();
        $message->message = $messageData->message;
        $message->owner = auth()->user()->id;
        $message->conversation = $conversation->id;
        $message->save();

        $this->updateConversationMessageCount($conversation);

        return $message;
    }

    public function updateConversationMessageCount($conversation)
    {
        $count = \App\Models\Conversation\Message::where('conversation', '=', $conversation->id)->count();
        $conversation->messages_count = $count;
        $conversation->save();
    }
}
