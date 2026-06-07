@forelse($reports as $report)
    <tr>

        <td>{{ $report->user->name }}</td>

        <td>{{ $report->user->employee->employee_id }}</td>

        <td>{{ $report->user->employee->department }}</td>

        <td>
            {{ Str::title(str_replace('_', ' ', $report->leaveType->name)) }}
        </td>

        <td>{{ $report->start_date }}</td>

        <td>{{ $report->end_date }}</td>

        <td>{{ $report->total_days }}</td>

        <td>{{ ucfirst($report->status) }}</td>

        <td>{{ $report->manager_id ?? '-' }}</td>

        <td>{{ $report->approved_at ?? '-' }}</td>

    </tr>

@empty

    <tr>

        <td colspan="10" class="text-center">

            No Records Found

        </td>

    </tr>
@endforelse
