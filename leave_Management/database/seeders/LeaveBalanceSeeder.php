<?php

namespace Database\Seeders;

use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = User::where('role', 'employee')->get();

        $leaveTypes = LeaveType::all();

        foreach ($employees as $employee) {

            foreach ($leaveTypes as $leaveType) {

                LeaveBalance::create([
                    'user_id' => $employee->id,
                    'leave_type_id' => $leaveType->id,
                    'allocated_days' =>
                        $leaveType->default_count,
                    'used_days' => 0,
                    'remaining_days' =>
                        $leaveType->default_count,
                ]);
            }
        }
    }
}
