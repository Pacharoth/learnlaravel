<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use App\Event\NewChatMessage;

class ChatController extends Controller
{
    //List room
    public function rooms(Request $request){
        return ChatRoom::all();
    }

    public function messages(Request $request,$roomId){
        return ChatMessage::where('chat_room_id',$roomId)->with('user')->orderBy('created_at','DESC')
        ->get();
    }

    public function newMessage( Request $request,$roomId){
        $newMessage = new ChatMessage([
            "user_id"=>Auth::id(),
            "chat_room_id"=>$roomId,
            "message"=>$request->message
        ]);
        $newMessage->save();
        broadcast(new NewChatMessage($newMessage))->toOthers();
        return $newMessage;
    }
}
