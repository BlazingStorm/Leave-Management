@extends('layouts.app')

@section('content')

    <div class="container py-4">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            Apply Leave
                        </h4>
                    </div>

                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>
                        @endif
                        <div class="row mb-4">

                            @foreach ($balances as $balance)
                                <div class="col-md-4">

                                    <div class="card border-success">

                                        <div class="card-body text-center">

                                            <h6 class="text-muted">

                                                {{ Str::title(str_replace('_', ' ', $balance->leaveType->name)) }}

                                            </h6>

                                            <h3 class="text-success">

                                                {{ $balance->remaining_days }}

                                            </h3>

                                            <small>
                                                Days Remaining
                                            </small>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                        <form action="{{ route('employee.leave.store') }}" method="POST" id="leaveForm">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Leave Type
                                </label>

                                <select name="leave_type_id" class="form-select">

                                    <option value="">
                                        Select Leave Type
                                    </option>

                                    @foreach ($leaveTypes as $leaveType)
                                        <option value="{{ $leaveType->id }}"
                                            {{ old('leave_type_id') == $leaveType->id ? 'selected' : '' }}>

                                            {{ Str::title(str_replace('_', ' ', $leaveType->name)) }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Start Date
                                        </label>

                                        <input type="date" name="start_date" value="{{ old('start_date') }}"
                                            class="form-control">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            End Date
                                        </label>

                                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                                            class="form-control">

                                    </div>

                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Reason
                                </label>

                                <textarea name="reason" rows="4" class="form-control" placeholder="Enter leave reason">{{ old('reason') }}</textarea>

                            </div>

                            <div class="d-flex justify-content-end">

                                <button type="submit" class="btn btn-primary">

                                    Submit Leave Request

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <script>
        document
            .getElementById('leaveForm')
            .addEventListener('submit', async function(e) {

                e.preventDefault();

                const formData = new FormData(this);

                const response = await fetch(
                    this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,

                            'Accept': 'application/json'
                        }
                    }
                );

                const data = await response.json();

                alert(data.message);

            });
    </script>
@endsection
