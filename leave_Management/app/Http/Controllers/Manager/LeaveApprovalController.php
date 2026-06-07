<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\RejectLeaveRequest;
use App\Models\AuditLog;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveApprovalController extends Controller
{
    public function index()
    {
        $requests = LeaveRequest::query()

            ->where('manager_id', auth()->id())
            ->with(['user.employee', 'leaveType'])
            ->latest()
            ->get();

        return view(
            'manager.leave.index',
            compact('requests')
        );
    }

    public function approve(LeaveRequest $leave)
    {
        if ($leave->status !== 'pending') {
            return back();
        }

        DB::transaction(function ()
        use ($leave) {

            $leave->update([

                'status' => 'approved',

                'approved_at' => now()
            ]);

            $balance = LeaveBalance::query()
                ->where('user_id', $leave->user_id)
                ->where('leave_type_id', $leave->leave_type_id)
                ->first();

            $balance->increment('used_days', $leave->total_days);

            $balance->decrement('remaining_days', $leave->total_days);

            AuditLog::create([

                'user_id' => auth()->id(),

                'action' => 'Leave Approved',

                'description' =>
                'Approved leave request #' . $leave->id
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Leave approved successfully'
        ]);
    }

    public function reject(RejectLeaveRequest $request, LeaveRequest $leave)
    {
        $leave->update([

            'status' => 'rejected',

            'manager_remarks' => $request->remarks,

            'approved_at' => now()
        ]);

        AuditLog::create([

            'user_id' => auth()->id(),

            'action' => 'Leave Rejected',

            'description' =>
            'Rejected leave request #' . $leave->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Leave rejected successfully'
        ]);
    }
}
