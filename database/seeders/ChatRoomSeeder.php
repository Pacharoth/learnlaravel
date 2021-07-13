<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // the same as Model::create([something=>something])


        /* When we run this it will create two room
        1 is for General and the next is tech talk */
        DB::table('chat_rooms')->insert([
            'name'=>'General'
        ]);
        DB::table('chat_rooms')->insert([
            'name'=>'Tech Talk'
        ]);
        //after this u have to populate the chat room table to something
    }
}
