<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\Admin\TimetableController;
use App\Http\Controllers\Admin\MasterTimetableController; // ✅ Add this
use App\Http\Middleware\AdminMiddleware; // ✅ Import middleware class

// Show Authentication Forms
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Handle Authentication Requests
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Dashboard Routes (Protected with Auth Middleware)
Route::middleware(['auth'])->group(function () {

    // Default dashboard redirect
    Route::get('/dashboard', function () {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return Auth::user()->is_admin 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('user.dashboard');
    })->name('dashboard');

    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin-only Routes
    Route::middleware([AdminMiddleware::class])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        // ✅ Timetables
        Route::resource('timetables', TimetableController::class);
        Route::get('timetables-export', [TimetableController::class, 'exportCsv'])->name('timetables.export');

        // ✅ Master Timetables
        Route::resource('master_timetables', MasterTimetableController::class);
    });

    // Admin: Manage Users
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

    // User Dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ✅ Test Route for Admin Middleware
Route::get('/test-admin-middleware', function () {
    return "✔️ You passed the admin middleware.";
})->middleware(['web', 'auth', AdminMiddleware::class]);
