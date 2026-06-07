<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::all();

        return view(
            'admin.leave-types.index',
            compact('leaveTypes')
        );
    }

    public function edit(LeaveType $leaveType)
    {
        return view(
            'admin.leave-types.edit',
            compact('leaveType')
        );
    }

    public function update(Request $request,LeaveType $leaveType) 
    {
        $request->validate([
            'default_count' => 'required|integer|min:1'
        ]);

        $leaveType->update([
            'default_count' => $request->default_count
        ]);

        return redirect()
            ->route('leave-types.index')
            ->with('success','Leave allocation updated.');
    }
}
