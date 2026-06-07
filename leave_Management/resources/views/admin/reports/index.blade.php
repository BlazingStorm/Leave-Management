@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h3 class="mb-4">

            Leave Reports

        </h3>

        <div class="card mb-4">

            <div class="card-body">

                <form method="GET" id="report-form">

                    <div class="row">

                        <div class="col-md-3">

                            <input type="text" id="employee_name" name="employee_name"
                                value="{{ request('employee_name') }}" placeholder="Employee Name" class="form-control">

                        </div>

                        <div class="col-md-2">

                            <input type="text" id='department' name="department" value="{{ request('department') }}"
                                placeholder="Department" class="form-control">

                        </div>

                        <div class="col-md-2">

                            <select name="leave_type_id" id="leave_type_id" class="form-select">

                                <option value="">
                                    All Types
                                </option>

                                @foreach ($leaveTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ request('leave_type_id') == $type->id ? 'selected' : '' }}>

                                        {{ Str::title(str_replace('_', ' ', $type->name)) }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2">

                            <select name="status" id="status" class="form-select">

                                <option value="">
                                    All Status

                                </option>

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="approved">
                                    Approved
                                </option>

                                <option value="rejected">
                                    Rejected
                                </option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <button type="button" class="btn btn-primary">

                                Auto Filter Enabled

                            </button>

                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-md-3">

                            <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}"
                                class="form-control">

                        </div>

                        <div class="col-md-3">

                            <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}"
                                class="form-control">

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="card">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>

                        <tr>

                            <th>Employee</th>
                            <th>Employee ID</th>
                            <th>Department</th>
                            <th>Leave Type</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Approved By</th>
                            <th>Approval Date</th>

                        </tr>

                    </thead>

                    <tbody id="report-table-body">

                        @include('admin.reports.partials.table')

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const reportForm =
            document.getElementById(
                'report-form'
            );

        reportForm
            .querySelectorAll(
                'input, select'
            )
            .forEach(field => {

                field.addEventListener(
                    'change',
                    loadReports
                );

                field.addEventListener(
                    'keyup',
                    loadReports
                );

            });

        function loadReports() {
            const params =
                new URLSearchParams(
                    new FormData(
                        reportForm
                    )
                );

            fetch(
                    `/admin/reports?${params}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                )

                .then(response =>
                    response.text()
                )

                .then(html => {

                    document
                        .getElementById(
                            'report-table-body'
                        )
                        .innerHTML = html;

                });
        }
    </script>
@endpush
