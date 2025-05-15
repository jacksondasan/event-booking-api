<?php

namespace Tests\Feature;

use App\Models\Attendee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_register_attendee(): void
    {
        $attendeeData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890'
        ];

        $response = $this->postJson('/api/attendees', $attendeeData);

        $response->assertStatus(201)
            ->assertJsonFragment(['email' => 'john@example.com']);
    }

    public function test_cannot_register_attendee_with_duplicate_email(): void
    {
        Attendee::factory()->create(['email' => 'john@example.com']);

        $attendeeData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890'
        ];

        $response = $this->postJson('/api/attendees', $attendeeData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}
