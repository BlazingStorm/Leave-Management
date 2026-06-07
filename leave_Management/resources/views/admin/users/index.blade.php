@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between mb-4">

            <h3>User Management</h3>

            <a href="{{ route('users.create') }}" class="btn btn-primary">

                Add User

            </a>

        </div>

        <div class="mb-3">

            <input type="text" id="user-search" name="search" value="{{ request('search') }}"
                placeholder="Name / Employee ID / Department" class="form-control">



            <div class="card shadow-sm">

                <div class="table-responsive">

                    <table class="table mb-0">

                        <thead>

                            <tr>

                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody id="user-table-body">

                            @include('admin.users.partials.table')

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="mt-3">

                {{ $users->links() }}

            </div>

        </div>
    @endsection
    @push('scripts')
        <script>
            document
                .getElementById('user-search')
                .addEventListener('keyup', function() {

                    let search = this.value;

                    fetch(
                            `/admin/users?search=${encodeURIComponent(search)}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            }
                        )
                        .then(response => response.text())
                        .then(html => {

                            document
                                .getElementById('user-table-body')
                                .innerHTML = html;

                        });

                });
        </script>
    @endpush
