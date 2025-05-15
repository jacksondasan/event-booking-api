<?php

namespace Tests\Feature;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_book_event(): void
    {
        $event = Event::factory()->create(['capacity' => 5]);
        $attendee = Attendee::factory()->create();

        $response = $this->actingAs($this->user)
            ->postJson('/api/bookings', [
                'event_id' => $event->id,
                'attendee_id' => $attendee->id
            ]);

        $response->assertStatus(201);
    }

    public function test_cannot_book_fully_booked_event(): void
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee1 = Attendee::factory()->create();
        $attendee2 = Attendee::factory()->create();

        // First booking
        $this->actingAs($this->user)
            ->postJson('/api/bookings', [
                'event_id' => $event->id,
                'attendee_id' => $attendee1->id
            ]);

        // Second booking attempt
        $response = $this->actingAs($this->user)
            ->postJson('/api/bookings', [
                'event_id' => $event->id,
                'attendee_id' => $attendee2->id
            ]);

        $response->assertStatus(422)
            ->assertJson(['message' => 'Event is fully booked']);
    }

    public function test_cannot_book_same_event_twice(): void
    {
        $event = Event::factory()->create(['capacity' => 5]);
        $attendee = Attendee::factory()->create();

        // First booking
        $this->actingAs($this->user)
            ->postJson('/api/bookings', [
                'event_id' => $event->id,
                'attendee_id' => $attendee->id
            ]);

        // Second booking attempt
        $response = $this->actingAs($this->user)
            ->postJson('/api/bookings', [
                'event_id' => $event->id,
                'attendee_id' => $attendee->id
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['event_id']);
    }
}
