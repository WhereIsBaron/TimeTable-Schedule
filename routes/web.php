<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;

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

    // Admin: Manage Users
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');

    // Admin: Create User
    Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');

    // Admin: Edit + Update User
    Route::get('/admin/users/{id}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');

    // Admin: Delete User
    Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

    // User Dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
