<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'employee_id' => 'EMP'.fake()->unique()->numberBetween(1000,9999),

            'mobile' => fake()->numerify('##########'),

            'department' => fake()->randomElement([
                'IT',
                'HR',
                'Finance'
            ]),

            'designation' => fake()->jobTitle(),

            'manager_id' => null,
        ];
    }
}
