<?php

namespace Database\Seeders;

use App\Models\Attendee;
use Illuminate\Database\Seeder;

class AttendeesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 attendees
        Attendee::factory(50)->create();
    }
}
