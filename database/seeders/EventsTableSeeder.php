<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        // Create 20 events distributed among users
        foreach ($users as $user) {
            Event::factory(2)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
