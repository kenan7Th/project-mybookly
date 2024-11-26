<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MYUser; // Use the correct namespace for your user model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register a new user
    public function userregister(Request $request)
    {
        // Validate the fields
        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:my_users,email', // Ensure the table name matches your DB
            'password' => 'required|string|min:8',
        ]);

        // Create the user
        $myuser = MYUser::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']), // Hash the password for security
        ]);

        // Return response with user and token
        return response()->json([
            'myuser' => $myuser,
            'token' => $myuser->createToken('auth_token')->plainTextToken, // Ensure Sanctum is set up
        ], 201); // 201 for created resource
    }

    // User login
    public function userlogin(Request $request)
    {
        // Validate the fields
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Attempt to authenticate
        if (!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401); // 401 for unauthorized
        }

        // Retrieve the authenticated user
        $myuser = MYUser::where('email', $credentials['email'])->firstOrFail();

        // Return response with user and token
        return response()->json([
            'myuser' => $myuser,
            'token' => $myuser->createToken('auth_token')->plainTextToken, // Ensure Sanctum is set up
        ], 200); // 200 for success
    }

    // User logout
    public function userlogout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        // Return a successful logout message
        return response()->json([
            'message' => 'Logged out successfully',
        ], 200); // 200 for success
    }

    // Get user details
    public function myuser(Request $request)
    {
        return response()->json([
            'myuser' => $request->user(), // Retrieve the currently authenticated user
        ], 200); // 200 for success
    }
}
