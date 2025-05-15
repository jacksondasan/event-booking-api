<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::all();
        $attendees = Attendee::all();

        // Create random bookings
        foreach ($events as $event) {
            // Get random attendees for this event (between 1 and 5)
            $randomAttendees = $attendees->random(rand(1, 5));
            
            foreach ($randomAttendees as $attendee) {
                Booking::factory()->create([
                    'event_id' => $event->id,
                    'attendee_id' => $attendee->id,
                ]);
            }
        }
    }
}
