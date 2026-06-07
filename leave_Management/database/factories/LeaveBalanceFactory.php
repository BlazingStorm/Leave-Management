<?php

namespace Database\Factories;

use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeaveBalance>
 */
class LeaveBalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $allocated = fake()->numberBetween(1, 10);

        $used = fake()->numberBetween(0 , $allocated);
        return [
            'user_id' => User::factory(),
            'leave_type_id' => LeaveType::factory(),
            'allocated_days' => $allocated , 
            'used_days' => $used , 
            'remaining_days' => $allocated - $used

        ];
    }
}
