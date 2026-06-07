<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees =
            Employee::count();

        $activeEmployees =
            User::where('status', 'active')
            ->count();

        $inactiveEmployees =
            User::where('status', 'inactive')
            ->count();

        $totalRequests = LeaveRequest::count();

        $approved = LeaveRequest::where('status', 'approved')
            ->count();

        $pending = LeaveRequest::where('status', 'pending')
            ->count();

        $rejected = LeaveRequest::where('status', 'rejected')
            ->count();

        return view('admin.dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
            'totalRequests',
            'approved',
            'pending',
            'rejected'
        ));
    }

    public function create()
    {
        return view('admin.users.create');
    }
}
