@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h3 class="mb-4">

            Audit Logs

        </h3>

        <div class="card">

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr>

                            <th>User</th>

                            <th>Action</th>

                            <th>Description</th>

                            <th>Date</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($logs as $log)
                            <tr>

                                <td>
                                    {{ $log->user->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $log->action }}
                                </td>

                                <td>
                                    {{ $log->description }}
                                </td>

                                <td>
                                    {{ $log->created_at }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
