<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Ticket;
use App\Models\User;
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
        /** @var User[] $users */
         $users = User::factory(10)->create();

         foreach ($users as $user) {
            Ticket::factory(5)->create([
                'author_id' => $user->id
            ]);
         }
    }
}
