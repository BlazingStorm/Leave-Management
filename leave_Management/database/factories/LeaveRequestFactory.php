<?php

namespace Database\Factories;

use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-30 days', '+30 days');

        $days = fake()->numberBetween(1, 5);

        $end = (clone $start)->modify("+{$days} days");
        return [
            'user_id' => User::factory(),

            'leave_type_id' => LeaveType::factory(),

            'start_date' => $start,

            'end_date' => $end,

            'total_days' => $days,

            'reason' => fake()->sentence(),

            'status' => fake()->randomElement([
                'pending',
                'approved',
                'rejected'
            ]),
        ];
    }
}
