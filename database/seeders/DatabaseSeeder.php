<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //after this you have to run database seeder
        //php artisan  db:seeder
        $this->call([
            ChatRoomSeeder::class
        ]);
    }
}
