<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'student_id' => 'required|string|unique:users',
            'class_code' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the new user
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'class_code' => $request->class_code,
            'password' => Hash::make($request->password),
            'is_admin' => false,  // Default to non-admin
        ]);

        // Redirect to login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // Login User
    public function login(Request $request)
    {
        // Validate login credentials
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to log the user in using the 'web' guard
        if (Auth::guard('web')->attempt($credentials)) {
            // Get the authenticated user
            $user = Auth::user();

            // Redirect based on the user role
            return redirect()->to($user->is_admin ? '/admin/dashboard' : '/user/dashboard')->with('success', 'Login successful!');
        } else {
            // If login fails, return back with an error message
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    // Logout User
    public function logout()
    {
        Auth::logout();

        // Redirect to login page with a success message
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
