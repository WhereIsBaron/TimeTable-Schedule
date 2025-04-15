<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use App\Models\User;

// class LoginController extends Controller
// {
//     // Handle the login request
//     public function login(Request $request)
//     {
//         // Validate the login credentials
//         $credentials = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         // Find the user by email
//         $user = User::where('email', $request->email)->first();

//         // Check if the user exists and the password is correct
//         if (!$user || !Hash::check($request->password, $user->password)) {
//             return response()->json(['message' => 'Invalid credentials'], 401);
//         }

//         // Generate a token for the authenticated user
//         $token = $user->createToken('auth_token')->plainTextToken;

//         // Return the user and the token
//         return response()->json([
//             'user' => $user,
//             'token' => $token,
//         ]);
//     }
// }
