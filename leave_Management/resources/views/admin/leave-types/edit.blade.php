@extends('layouts.app')

@section('content')

    <div class="container py-4">

        <div class="card shadow-sm">

            <div class="card-header">

                <h4 class="mb-0">
                    Edit Leave Type
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

                <form action="{{ route('leave-types.update', $leaveType) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">

                            Leave Type

                        </label>

                        <input type="text" class="form-control"
                            value="{{ Str::title(str_replace('_', ' ', $leaveType->name)) }}" disabled>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Default Allocation (Days)

                        </label>

                        <input type="number" name="default_count"
                            value="{{ old('default_count', $leaveType->default_count) }}" class="form-control"
                            min="0" required>

                    </div>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('leave-types.index') }}" class="btn btn-secondary me-2">

                            Cancel

                        </a>

                        <button type="submit" class="btn btn-primary">

                            Update Leave Type

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
