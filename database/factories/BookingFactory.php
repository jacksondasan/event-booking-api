<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'attendee_id' => \App\Models\Attendee::factory(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'ticket_quantity' => $this->faker->numberBetween(1, 5),
            'booking_date' => $this->faker->dateTimeBetween('-1 month', 'now')
        ];
    }
}
