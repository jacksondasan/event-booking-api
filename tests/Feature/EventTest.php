<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
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

    public function test_can_get_events_list(): void
    {
        Event::factory()->count(5)->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    public function test_can_create_event(): void
    {
        $eventData = [
            'title' => 'Test Event',
            'description' => 'Test Description',
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(2),
            'country' => 'Test Country',
            'venue' => 'Test Venue',
            'capacity' => 100
        ];

        $response = $this->actingAs($this->user)
            ->postJson('/api/events', $eventData);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test Event']);
    }

    public function test_cannot_create_event_with_invalid_dates(): void
    {
        $eventData = [
            'title' => 'Test Event',
            'description' => 'Test Description',
            'start_date' => now()->subDays(1),
            'end_date' => now()->addDays(2),
            'country' => 'Test Country',
            'venue' => 'Test Venue',
            'capacity' => 100
        ];

        $response = $this->actingAs($this->user)
            ->postJson('/api/events', $eventData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['start_date']);
    }
}
