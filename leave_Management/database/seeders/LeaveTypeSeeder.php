<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveType::query()->create([
            'name' => 'Casual_leave' , 
            'default_count' => 10 , 
        ]);

        LeaveType::query()->create([
            'name' => 'Sick_leave' , 
            'default_count' => 12 , 
        ]);

        LeaveType::query()->create([
            'name' => 'Earned_leave' , 
            'default_count' => 5 , 
        ]);

    }
}
