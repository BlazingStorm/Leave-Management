@extends('layouts.app')

@section('content')

    <div class="container py-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white">

                <h4 class="mb-0">

                    Create User

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

                <form action="{{ route('users.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Employee ID

                            </label>

                            <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Employee Name

                            </label>

                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Mobile

                            </label>

                            <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Department

                            </label>

                            <input type="text" name="department" class="form-control" value="{{ old('department') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Designation

                            </label>

                            <input type="text" name="designation" class="form-control" value="{{ old('designation') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Role

                            </label>

                            <select name="role" class="form-select">

                                <option value="employee">
                                    Employee
                                </option>

                                <option value="manager">
                                    Manager
                                </option>

                                <option value="admin">
                                    Admin
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="active">
                                    Active
                                </option>

                                <option value="inactive">
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">

                        Create User

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection
