<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

// class RegisterController extends Controller
// {
//     public function register(Request $request)
//     {
//         // Validate the incoming request
//         $validated = $request->validate([
//             'full_name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'student_id' => 'required|string|unique:users',
//             'class_code' => 'required|string',
//             'password' => 'required|string|min:6',
//         ]);

//         // Create the new user
//         $user = User::create([
//             'full_name' => $validated['full_name'],
//             'email' => $validated['email'],
//             'student_id' => $validated['student_id'],
//             'class_code' => $validated['class_code'],
//             'password' => Hash::make($validated['password']),
//             'is_admin' => false,
//         ]);

//         // Return a success message along with the token and user info
//         return response()->json([
//             'message' => 'Registration successful',
//             'user' => $user,
//         ], 201);
//     }
// } 