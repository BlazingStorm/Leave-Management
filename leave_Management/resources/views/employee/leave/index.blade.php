@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="mb-1">
                    Leave History
                </h3>

                <p class="text-muted mb-0">
                    View all submitted leave requests
                </p>
            </div>

            <a href="{{ route('employee.leave.create') }}" class="btn btn-primary">

                Apply Leave

            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif

        <div class="row mb-4">

            <div class="col-md-3">

                <div class="card border-0 shadow-sm">

                    <div class="card-body text-center">

                        <h6 class="text-muted">
                            Total Requests
                        </h6>

                        <h2 class="fw-bold mb-0">
                            {{ $total }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-2">

                <div class="card border-0 shadow-sm">

                    <div class="card-body text-center">

                        <h6 class="text-success">
                            Approved
                        </h6>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $approved }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-2">

                <div class="card border-0 shadow-sm">

                    <div class="card-body text-center">

                        <h6 class="text-warning">
                            Pending
                        </h6>

                        <h2 class="fw-bold text-warning mb-0">
                            {{ $pending }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-2">

                <div class="card border-0 shadow-sm">

                    <div class="card-body text-center">

                        <h6 class="text-danger">
                            Rejected
                        </h6>

                        <h2 class="fw-bold text-danger mb-0">
                            {{ $rejected }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-0 shadow-sm">

                    <div class="card-body text-center">

                        <h6 class="text-primary">
                            Remaining
                        </h6>

                        <h2 class="fw-bold text-primary  mb-0">
                            {{ $remaining }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-body">

                    <form method="GET">

                        <div class="row">

                            <div class="col-md-3">

                                <label class="form-label">
                                    Leave Type
                                </label>

                                <select name="leave_type_id" class="form-select">

                                    <option value="">
                                        All
                                    </option>

                                    @foreach ($leaveTypes as $leaveType)
                                        <option value="{{ $leaveType->id }}"
                                            {{ request('leave_type_id') == $leaveType->id ? 'selected' : '' }}>

                                            {{ Str::title(str_replace('_', ' ', $leaveType->name)) }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-2">

                                <label class="form-label">
                                    Status
                                </label>

                                <select name="status" class="form-select">

                                    <option value="">
                                        All
                                    </option>

                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                        Approved
                                    </option>

                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-2">

                                <label class="form-label">
                                    From Date
                                </label>

                                <input type="date" name="from_date" value="{{ request('from_date') }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-2">

                                <label class="form-label">
                                    To Date
                                </label>

                                <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">

                            </div>

                            <div class="col-md-3 d-flex align-items-end">

                                <button type="submit" class="btn btn-primary me-2">

                                    Filter

                                </button>

                                <a href="{{ route('employee.leave.index') }}" class="btn btn-secondary">

                                    Reset

                                </a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
        <div class="card shadow-sm border-0">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Leave Type</th>

                                <th>Start Date</th>

                                <th>End Date</th>

                                <th>Days</th>

                                <th>Applied On</th>

                                <th>Status</th>

                                <th>Manager Remarks</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($leaves as $leave)
                                <tr>

                                    <td>
                                        {{ $leave->id }}
                                    </td>

                                    <td>
                                        {{ Str::title(str_replace('_', ' ', $leave->leaveType->name)) }}
                                    </td>

                                    <td>
                                        {{ $leave->start_date->format('d M Y') }}
                                    </td>

                                    <td>
                                        {{ $leave->end_date->format('d M Y') }}
                                    </td>

                                    <td>
                                        {{ $leave->total_days }}
                                    </td>

                                    <td>
                                        {{ $leave->created_at->format('d M Y') }}
                                    </td>

                                    <td>

                                        @if ($leave->status === 'approved')
                                            <span class="badge bg-success">
                                                Approved
                                            </span>
                                        @elseif($leave->status === 'rejected')
                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $leave->manager_remarks ?? '-' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="text-center py-4">

                                        No leave requests found.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
