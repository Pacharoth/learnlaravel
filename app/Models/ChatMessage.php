<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    //create relation ship with chat message
    public function room(){
        //One chat can have One room
        return $this->hasOne('App\Models\ChatRoom','id','chat_room_id');
    }
    //can have only one user for one message
    public function user(){
        //One chat can have One room
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
