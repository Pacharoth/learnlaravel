<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;
    //all chat room have relationship with chat message
    public function messages() {
        // chat room has many message
        return $this->hasMany('App\Models\ChatMessage');
    }
}
