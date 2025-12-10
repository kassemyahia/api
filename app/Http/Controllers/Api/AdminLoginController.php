<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthController extends Controller
{
    /**
     * 🔐 Login ONLY for Dashboard Admin Panel
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'], // email OR username
            'password' => ['required', 'string'],
        ]);

        // Determine if login via email or username
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password,
        ];

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid username/email or password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        // ⭐ REQUIRE USER TO BE ADMIN
        if ($user->usertype !== 'admin') {
            return response()->json([
                'message' => 'Access denied — admins only.',
            ], Response::HTTP_FORBIDDEN);
        }

        // Delete old tokens
        $user->tokens()->delete();

        // Issue new admin token
        $token = $user->createToken('dashboard_admin')->plainTextToken;

        return response()->json([
            'message' => 'Admin login successful.',
            'token' => $token,
            'user' => $user,
        ], Response::HTTP_OK);
    }

    /**
     * 🚪 Logout for admin panel
     */
    public function logout(Request $request)
    {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json([
            'message' => 'Logged out successfully.',
        ], Response::HTTP_OK);
    }
}
