<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;


class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->message;
        $user = auth()->user();

        // Broadcast the message to other users
        broadcast(new MessageSent($message, $user))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }
}
