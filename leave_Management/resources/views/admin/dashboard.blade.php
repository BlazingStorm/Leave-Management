@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h3 class="mb-4">
            Admin Dashboard
        </h3>

        <div class="row g-3">

            <div class="col-md-3">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-muted">
                            Total Employees
                        </h6>

                        <h2 class="fw-bold">
                            {{ $totalEmployees }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-success">
                            Active Employees
                        </h6>

                        <h2 class="fw-bold text-success">
                            {{ $activeEmployees }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-danger">
                            Inactive Employees
                        </h6>

                        <h2 class="fw-bold text-danger">
                            {{ $inactiveEmployees }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-primary">
                            Total Requests
                        </h6>

                        <h2 class="fw-bold text-primary">
                            {{ $totalRequests }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-success">
                            Approved Leaves
                        </h6>

                        <h2 class="fw-bold text-success">
                            {{ $approved }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-warning">
                            Pending Approvals
                        </h6>

                        <h2 class="fw-bold text-warning">
                            {{ $pending }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-danger">
                            Rejected Leaves
                        </h6>

                        <h2 class="fw-bold text-danger">
                            {{ $rejected }}
                        </h2>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
