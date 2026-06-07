<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\AuditLog;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $users = User::query()

            ->with('employee')

            ->when(
                $request->search,
                function ($query) use ($request) {

                    $query->where('name', 'like', "%{$request->search}%")
                        ->orWhereHas(
                            'employee',
                            function ($q) use ($request) {
                                $q->where(
                                    'employee_id',
                                    'like',
                                    "%{$request->search}%"
                                )

                                    ->orWhere(
                                        'department',
                                        'like',
                                        "%{$request->search}%"
                                    );
                            }
                        );
                }
            )

            ->paginate(10);

        if ($request->ajax()) {

            return view(
                'admin.users.partials.table',
                compact('users')
            )->render();
        }

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {

            $user = User::create([

                'name' => $request->name,

                'email' => $request->email,

                'password' => Hash::make('password'),

                'role' => $request->role,

                'status' => $request->status,
            ]);

            AuditLog::create([

                'user_id' => auth()->id(),

                'action' => 'User Created',

                'description' =>
                'Created user ' . $user->name
            ]);

            Employee::create([

                'user_id' => $user->id,

                'employee_id' => $request->employee_id,

                'mobile' => $request->mobile,

                'department' => $request->department,

                'designation' => $request->designation,
            ]);
            foreach (LeaveType::all() as $leaveType) {
                LeaveBalance::create([
                    'user_id' => $user->id,
                    'leave_type_id' => $leaveType->id,
                    'allocated_days' => $leaveType->default_count,
                    'used_days' => 0,
                    'remaining_days' => $leaveType->default_count,
                ]);
            }
        });


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User created successfully'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('employee');

        return view(
            'admin.users.edit',
            compact('user')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::transaction(function ()
        use ($request, $user) {

            $user->update([

                'name' => $request->name,

                'email' => $request->email,

                'role' => $request->role,

                'status' => $request->status,
            ]);

            $user->employee->update([

                'employee_id' => $request->employee_id,

                'mobile' => $request->mobile,

                'department' => $request->department,

                'designation' => $request->designation,
            ]);

            AuditLog::create([

                'user_id' => auth()->id(),

                'action' => 'User Updated',

                'description' =>
                'Updated user ' . $user->name
            ]);
        });

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
