@forelse ($users as $user)
    <tr>

        <td>
            {{ $user->employee->employee_id ?? '-' }}
        </td>

        <td>
            {{ $user->name }}
        </td>

        <td>
            {{ $user->email }}
        </td>

        <td>
            {{ $user->employee->department ?? '-' }}
        </td>

        <td>
            {{ ucfirst($user->role) }}
        </td>

        <td>

            @if ($user->status === 'active')
                <span class="badge bg-success">
                    Active
                </span>
            @else
                <span class="badge bg-danger">
                    Inactive
                </span>
            @endif

        </td>

        <td>

            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">

                Edit

            </a>

        </td>

    </tr>

@empty

    <tr>

        <td colspan="7" class="text-center">

            No users found

        </td>

    </tr>
@endforelse
