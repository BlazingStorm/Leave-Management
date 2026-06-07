<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LeaveController;

use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\LeaveApprovalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return match (auth()->user()->role) {

        'admin' => redirect()->route('admin.dashboard'),

        'manager' => redirect()->route('manager.dashboard'),

        'employee' => redirect()->route('employee.leave.index'),

        default => redirect()->route('login')
    };
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])
    ->prefix('employee')
    ->group(function () {
        Route::get('/leave', [LeaveController::class, 'index'])
            ->name('employee.leave.index');
        Route::get('/leave/create', [LeaveController::class, 'create'])
            ->name('employee.leave.create');
        Route::post('/leave', [LeaveController::class, 'store'])
            ->name('employee.leave.store');
    });


Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('manager.dashboard');

        Route::get('/leave-requests', [LeaveApprovalController::class, 'index'])
            ->name('manager.leave.index');

        Route::post('/leave/{leave}/approve', [LeaveApprovalController::class, 'approve'])
            ->name('manager.leave.approve');

        Route::post('/leave/{leave}/reject', [LeaveApprovalController::class, 'reject'])
            ->name('manager.leave.reject');
    });

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');
        Route::resource('users', UserController::class);
        Route::resource('leave-types', LeaveTypeController::class)
            ->only(['index', 'edit', 'update']);

        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');
        Route::get('/audit-logs', [AuditLogController::class, 'index'])
            ->name('audit-logs.index');
    });
