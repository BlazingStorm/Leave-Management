<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        Employee::create([
            'user_id' => $admin->id,
            'employee_id' => 'EMP001',
            'mobile' => '9999999999',
            'department' => 'Admin',
            'designation' => 'Administrator',
        ]);

        $manager1 = User::create([
            'name' => 'Manager1',
            'email' => 'manager1@test.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'status' => 'active',
        ]);

        $managerEmployee =  Employee::create([
            'user_id' => $manager1->id,
            'employee_id' => 'EMP002',
            'mobile' => '9999999998',
            'department' => 'IT',
            'designation' => 'Project Manager',
        ]);

        $manager2 = User::create([
            'name' => 'Manager2',
            'email' => 'manager2@test.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'status' => 'active',
        ]);

        $managerEmployee2 = Employee::create([
            'user_id' => $manager2->id,
            'employee_id' => 'EMP003',
            'mobile' => '9999999997',
            'department' => 'Finance',
            'designation' => 'Project Manager',
        ]);

        $employee = User::factory()->create([
            'name' => 'employee' ,
            'email' => 'employee@test.com' , 
            'password' => Hash::make('password') , 
            
            'role' => 'employee' , 
            'status' => 'active'
        ]);

        Employee::query()->create([
            'user_id' => $employee->id,
            'employee_id' => 'EMP004',
            'mobile' => '9999999996',
            'manager_id' => $manager1->id,
            'department' => 'IT',
            'designation' => 'juinor dev',

        ]);
        $managers = [$managerEmployee->id, $managerEmployee2->id];

        User::factory()->count(20)->employee()->create()
            ->each(function ($user) use ($managers) {
                Employee::query()->create([
                    'user_id' => $user->id,
                    'employee_id' => 'EMP' . str_pad($user->id + 100, 4, '0', STR_PAD_LEFT),
                    'mobile' => fake()->numerify('##########'),
                    'department' => fake()->randomElement([
                        'IT',
                        'HR',
                        'Finance'
                    ]),
                    'designation' => fake()->jobTitle(),

                    'manager_id' => fake()->randomElement($managers)
            
                ]);
            });
    }
}
