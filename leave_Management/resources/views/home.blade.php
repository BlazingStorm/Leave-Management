@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <h2>
                    Employee Leave Management System
                </h2>

                <p class="text-muted mt-3">

                    Welcome,
                    {{ auth()->user()->name }}

                </p>

                <p>

                    Role:
                    <strong>
                        {{ ucfirst(auth()->user()->role) }}
                    </strong>

                </p>

                <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="btn btn-primary">

                    Go To Dashboard

                </a>

            </div>

        </div>

    </div>
@endsection
