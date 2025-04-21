<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\Admin\TimetableController;
use App\Http\Controllers\Admin\MasterTimetableController;
use App\Http\Controllers\ClassCodeController;
use App\Http\Controllers\RoomController; // ✅ New
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\FacultyAdminMiddleware;

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

        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->is_faculty_admin) {
            return redirect()->route('faculty.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
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
            // Timetables
            Route::resource('timetables', TimetableController::class);
            Route::get('timetables-export', [TimetableController::class, 'exportCsv'])->name('timetables.export');

            // Master Timetables
            Route::resource('master_timetables', MasterTimetableController::class);

            // Class Code Management
            Route::resource('class_codes', ClassCodeController::class);

            // Room Management ✅
            Route::resource('rooms', RoomController::class);

            // User Management
            Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
            Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
            Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
            Route::get('/users/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
            Route::put('/users/{id}', [UserManagementController::class, 'update'])->name('users.update');
            Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
        });

    // Faculty Admin Dashboard
    Route::get('/faculty/dashboard', function () {
        return view('faculty.facultydashboard');
    })->name('faculty.dashboard')->middleware(FacultyAdminMiddleware::class);

    // Student Dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Optional test route
Route::get('/test-admin-middleware', function () {
    return "✔️ You passed the admin middleware.";
})->middleware(['web', 'auth', AdminMiddleware::class]);
