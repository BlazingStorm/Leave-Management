<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = LeaveRequest::query()
            ->with(['user.employee', 'leaveType']);

        $query->when(
            $request->employee_name,
            function ($q) use ($request) {

                $q->whereHas(
                    'user',
                    function ($userQuery)
                    use ($request) {

                        $userQuery->where(
                            'name',
                            'like',
                            "%{$request->employee_name}%"
                        );
                    }
                );
            }
        );

        $query->when(
            $request->department,
            function ($q) use ($request) {

                $q->whereHas(
                    'user.employee',
                    function ($employeeQuery) use ($request) {

                        $employeeQuery->where('department', 'like', "%{$request->department}%");
                    }
                );
            }
        );

        $query->when(
            $request->leave_type_id,
            fn($q) => $q
                ->where(
                    'leave_type_id',
                    $request->leave_type_id
                )
        );

        $query->when(
            $request->status,
            fn($q) =>
            $q->where(
                'status',
                $request->status
            )
        );

        $query->when(
            $request->from_date,
            fn($q) =>
            $q->whereDate(
                'start_date',
                '>=',
                $request->from_date
            )
        );

        $query->when(
            $request->to_date,
            fn($q) =>
            $q->whereDate(
                'end_date',
                '<=',
                $request->to_date
            )
        );

        $reports = $query
            ->latest()
            ->get();

        $leaveTypes =
            LeaveType::all();
        
            if ($request->ajax()) {

            return view(
                'admin.reports.partials.table',
                compact('reports')
            )->render();
        }
        return view(
            'admin.reports.index',
            compact(
                'reports',
                'leaveTypes'
            )
        );
    }
}
