<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log; // For logging information and errors
class AuthController extends Controller
{
    // Define the correct admin code
    private $adminCode = 'walid2004';



    public function register(Request $request)
    {
        try {
            // Validate the incoming data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:admins,email', // Unique email validation for the 'admins' table
                'password' => 'required|string|min:4',
                'admin_code' => 'required|string', // Admin code validation
            ]);

            // Check if the provided admin code matches the correct admin code
            if ($validatedData['admin_code'] !== $this->adminCode) {
                return response()->json(['message' => 'Invalid admin code.'], 403); // Forbidden if the admin code is wrong
            }

            // Create a new Admin user after validation and correct admin code
            $admin = Admin::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            // Return a success message
            return response()->json(['message' => 'Admin registered successfully', 'admin' => $admin], 201);

        } catch (ValidationException $e) {
            // If validation fails, return validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Catch any unexpected errors and log them
            \Log::error('Unexpected Error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error.'], 500);
        }
    }

    //login
    public function login(Request $request)
    {
        // Validate the incoming request
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'admin_code' => 'required|string', // Added admin code for validation
        ]);

        // Check if the provided admin code is correct
        if ($credentials['admin_code'] !== 'walid2004') {
            return response()->json(['message' => 'Invalid admin code'], 403); // Forbidden if admin code is wrong
        }

        // Attempt to find the admin by email
        $admin = Admin::where('email', $credentials['email'])->first();

        // Check if the admin exists and the password is correct
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Create a new Sanctum token for the authenticated admin
            $token = $admin->createToken('admin-token')->plainTextToken; // Token creation

            // Return the token and admin data as part of the response
            return response()->json([
                'message' => 'Login successful',
                'user' => $admin,
                'token' => $token, // Send the token back to the client
            ], 200);
        } else {
            // If the credentials are incorrect, return an error
            return response()->json(['message' => 'Invalid credentials' ], 401);
        }
    }







    public function verifyToken(Request $request)
    {
        // Ensure the request has the Authorization header with the token
        $token = $request->bearerToken();

        // If no token is provided, return an error response
        if (!$token) {
            return response()->json(['message' => 'Token missing'], 400);  // 400 for bad request
        }

        try {
            // Attempt to authenticate using Sanctum with the provided token
            $user = Auth::guard('sanctum')->user();  // This will automatically check the token

            // If user is authenticated, return success response
            if ($user) {
                return response()->json(['message' => 'Token is valid'], 200);
            } else {
                // If authentication fails (invalid or expired token)
                return response()->json(['message' => 'Invalid token'], 401); // 401 for unauthorized
            }
        } catch (\Exception $e) {
            // Catch any exceptions (e.g., token verification failures)
            return response()->json(['message' => 'Token verification failed', 'error' => $e->getMessage()], 500); // 500 for server error
        }
    }
    public function logout(Request $request)
    {
        // Get the token from the Authorization header
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token missing'], 400); // If the token is missing
        }

        try {
            // Get the authenticated user based on the provided token
            $user = Auth::guard('sanctum')->user();

            if ($user) {
                // Revoke the token that was used to authenticate the user
                $user->currentAccessToken()->delete(); // This deletes the token used for authentication

                return response()->json(['message' => 'Successfully logged out'], 200); // Return success
            }

            // If the user is not found or the token is invalid
            return response()->json(['message' => 'Invalid token or user not found'], 401); // Unauthorized

        } catch (\Exception $e) {
            // If an error occurs, return a server error message
            return response()->json(['message' => 'An error occurred during logout', 'error' => $e->getMessage()], 500); // Internal server error
        }
    }


}
