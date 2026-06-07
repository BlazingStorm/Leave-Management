@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h3 class="mb-4">
            Manager Dashboard
        </h3>

        <div class="row">

            <div class="col-md-3">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-muted">
                            Total Requests
                        </h6>

                        <h2 class="fw-bold">
                            {{ $total }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-warning">
                            Pending
                        </h6>

                        <h2 class="fw-bold text-warning">
                            {{ $pending }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-success">
                            Approved
                        </h6>

                        <h2 class="fw-bold text-success">
                            {{ $approved }}
                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">

                        <h6 class="text-danger">
                            Rejected
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
