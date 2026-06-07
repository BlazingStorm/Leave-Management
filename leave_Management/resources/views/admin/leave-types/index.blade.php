@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h3 class="mb-4">
            Leave Configuration
        </h3>

        <div class="card">

            <div class="table-responsive">

                <table class="table mb-0">

                    <thead>

                        <tr>

                            <th>Name</th>

                            <th>Default Allocation</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($leaveTypes as $leaveType)
                            <tr>

                                <td>

                                    {{ Str::title(str_replace('_', ' ', $leaveType->name)) }}

                                </td>

                                <td>

                                    {{ $leaveType->default_count }}

                                </td>

                                <td>

                                    <a href="{{ route('leave-types.edit', $leaveType) }}"
                                        class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
