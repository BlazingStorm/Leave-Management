<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Models\AuditLog;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $leaves = auth()->user()
            ->leaveRequests()
            ->with('leaveType')
            ->latest()
            ->get();

        $total = $leaves->count();

        $approved = $leaves->where('status', 'approved')->count();

        $pending = $leaves->where('status', 'pending')->count();

        $rejected = $leaves->where('status', 'rejected')->count();

        $remaining = auth()->user()->leaveBalances()->sum('remaining_days');

        $query = auth()->user()
            ->leaveRequests()
            ->with('leaveType');

        $query->when(
            $request->leave_type_id,
            fn($q) => $q->where('leave_type_id', $request->leave_type_id)
        );

        $query->when($request->status, fn($q) => $q->where('status', $request->status));

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
            fn($q) => $q->whereDate(
                'end_date',
                '<=',
                $request->to_date
            )
        );

        $leaves = $query->latest()->get();

        $leaveTypes = LeaveType::all();
        return view('employee.leave.index', compact('leaves', 'total', 'pending', 'rejected', 'approved', 'remaining', 'leaveTypes'));
    }

    public function create()
    {
        $leaveTypes = LeaveType::all();
        $balances = auth()->user()
            ->leaveBalances()
            ->with('leaveType')
            ->get();

        return view(
            'employee.leave.create',
            compact(
                'leaveTypes',
                'balances'
            )
        );
    }

    public function store(StoreLeaveRequest $request)
    {
        $validated = $request->validated();
        $totalDays = Carbon::parse($request->start_date)
            ->diffInDays(Carbon::parse($request->end_date)) + 1;

        $balance = LeaveBalance::query()->where('user_id', auth()->id())
            ->where('leave_type_id', $request->leave_type_id)->first();
        if (!$balance) {
            return back()->withErrors(['leave_type_id' => 'No Leave left']);
        }

        if ($totalDays > $balance->remaining_days) {
            return back()->withInput()->withErrors([
                'leave_type_id' => 'Insuffiecient leave balance'
            ]);
        }

        $overlap = LeaveRequest::query()->where('user_id', auth()->id())
            ->where('status', '!=', 'rejected')
            ->where(function ($query) use ($request) {
                $query
                    ->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($q) use ($request) {

                        $q->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })->exists();

        if ($overlap) {
            return back()->withInput()->withErrors(['start_date' => 'overlapping leave days']);
        }
        $managerId = Employee::query()->where('user_id', auth()->id())->get('manager_id')->value('manager_id');
        $leave =   LeaveRequest::query()->create([
            'user_id' => auth()->id(),
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $totalDays,
            'reason' => $request->reason,
            'status' => 'pending',
            'manager_id' => $managerId
        ]);

        AuditLog::create([

            'user_id' => auth()->id(),

            'action' => 'Leave Applied',

            'description' =>
            'Applied for ' . $leave->leaveType->name .
                ' from ' . $leave->start_date .
                ' to ' . $leave->end_date
        ]);

        // dd($leave);
        return response()->json([
            'success' => true,
            'message' => 'Leave request submitted successfully',
            'leave_id' => $leave->id
        ]);
    }
}
