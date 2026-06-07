<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = LeaveRequest::where(
            'manager_id',
            auth()->id()
        )->count();

        $pending = LeaveRequest::where(
            'manager_id',
            auth()->id()
        )
            ->where('status', 'pending')
            ->count();

        $approved = LeaveRequest::where(
            'manager_id',
            auth()->id()
        )
            ->where('status', 'approved')
            ->count();

        $rejected = LeaveRequest::where(
            'manager_id',
            auth()->id()
        )
            ->where('status', 'rejected')
            ->count();

        return view(
            'manager.dashboard',
            compact(
                'total',
                'pending',
                'approved',
                'rejected'
            )
        );
    }
}
