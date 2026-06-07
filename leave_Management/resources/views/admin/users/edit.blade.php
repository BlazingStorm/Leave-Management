@extends('layouts.app')

@section('content')

    <div class="container py-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-warning text-dark">

                <h4 class="mb-0">
                    Edit User
                </h4>

            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>
                @endif

                <form action="{{ route('users.update', $user) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Employee ID

                            </label>

                            <input type="text" name="employee_id" class="form-control"
                                value="{{ old('employee_id', $user->employee->employee_id) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Employee Name

                            </label>

                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $user->name) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Mobile

                            </label>

                            <input type="text" name="mobile" class="form-control"
                                value="{{ old('mobile', $user->employee->mobile) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Department

                            </label>

                            <input type="text" name="department" class="form-control"
                                value="{{ old('department', $user->employee->department) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Designation

                            </label>

                            <input type="text" name="designation" class="form-control"
                                value="{{ old('designation', $user->employee->designation) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Role

                            </label>

                            <select name="role" class="form-select">

                                <option value="employee" {{ old('role', $user->role) == 'employee' ? 'selected' : '' }}>

                                    Employee

                                </option>

                                <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>

                                    Manager

                                </option>

                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>

                                    Admin

                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="inactive"
                                    {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-warning">

                            Update User

                        </button>

                        <a href="{{ route('users.index') }}" class="btn btn-secondary">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
