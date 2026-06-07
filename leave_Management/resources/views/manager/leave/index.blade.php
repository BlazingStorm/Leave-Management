@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="mb-1">
                    Leave Requests
                </h3>

                <p class="text-muted mb-0">
                    Review employee leave applications
                </p>

            </div>

        </div>

        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif

        <div class="card shadow-sm border-0">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>Employee</th>

                                <th>Employee ID</th>

                                <th>Department</th>

                                <th>Leave Type</th>

                                <th>Start Date</th>

                                <th>End Date</th>

                                <th>Days</th>

                                <th>Reason</th>

                                <th>Status</th>

                                <th width="180">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($requests as $leave)
                                <tr>

                                    <td>

                                        {{ $leave->user->name }}

                                    </td>

                                    <td>

                                        {{ $leave->user->employee->employee_id }}

                                    </td>

                                    <td>

                                        {{ $leave->user->employee->department }}

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

                                        {{ $leave->reason }}

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

                                        @if ($leave->status === 'pending')
                                            <button type="button" class="btn btn-success btn-sm approve-btn"
                                                data-id="{{ $leave->id }}">

                                                Approve

                                            </button>

                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal{{ $leave->id }}">

                                                Reject

                                            </button>
                                        @else
                                            -
                                        @endif

                                    </td>

                                </tr>

                                <div class="modal fade" id="rejectModal{{ $leave->id }}" tabindex="-1">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title">

                                                    Reject Leave

                                                </h5>

                                            </div>

                                            <form action="{{ route('manager.leave.reject', $leave) }}" method="POST">

                                                @csrf

                                                <div class="modal-body">

                                                    <label class="form-label">

                                                        Remarks

                                                    </label>

                                                    <textarea name="remarks" class="form-control" required></textarea>

                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">

                                                        Close

                                                    </button>

                                                    <button class="btn btn-danger">

                                                        Reject

                                                    </button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <tr>

                                    <td colspan="10" class="text-center py-4">

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

@push('scripts')
    <script>
        document
            .querySelectorAll('.approve-btn')
            .forEach(button => {

                button.addEventListener(
                    'click',
                    async function() {

                        const leaveId =
                            this.dataset.id;

                        const response =
                            await fetch(
                                `/manager/leave/${leaveId}/approve`, {
                                    method: 'POST',

                                    headers: {
                                        'X-CSRF-TOKEN': document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            .content
                                    }
                                }
                            );

                        const data =
                            await response.json();

                        alert(data.message);

                        location.reload();
                    }
                );

            });
    </script>

    <script>
    document
        .querySelectorAll('.reject-form')
        .forEach(form => {

            form.addEventListener(
                'submit',
                async function(e) {

                    e.preventDefault();

                    const leaveId =
                        this.dataset.id;

                    const formData =
                        new FormData(this);

                    const response =
                        await fetch(
                            `/manager/leave/${leaveId}/reject`, {
                                method: 'POST',

                                body: formData,

                                headers: {
                                    'X-CSRF-TOKEN': document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        .content
                                }
                            }
                        );

                    const data =
                        await response.json();

                    alert(data.message);

                    location.reload();
                }
            );

        });
</script>

@endpush

<script>
    document
        .querySelectorAll('.reject-form')
        .forEach(form => {

            form.addEventListener(
                'submit',
                async function(e) {

                    e.preventDefault();

                    const leaveId =
                        this.dataset.id;

                    const formData =
                        new FormData(this);

                    const response =
                        await fetch(
                            `/manager/leave/${leaveId}/reject`, {
                                method: 'POST',

                                body: formData,

                                headers: {
                                    'X-CSRF-TOKEN': document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        .content
                                }
                            }
                        );

                    const data =
                        await response.json();

                    alert(data.message);

                    location.reload();
                }
            );

        });
</script>
