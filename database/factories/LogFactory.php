<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_id' => \App\Models\Ticket::inRandomOrder()->first()->id ?? 1,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            'action' => $this->faker->sentence(),
            'created_at' => now()
        ];
    }
}
