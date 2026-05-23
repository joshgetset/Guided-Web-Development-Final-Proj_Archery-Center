<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid email or password.',
            ], 422);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        return response()->json([
            'message' => 'Sign in successful',
            'user' => [
                'name' => $user->name,
                'initials' => $this->formatInitials($user),
            ],
        ]);
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'max:25'],
            'archery_status' => ['required', 'in:beginner,intermediate,advanced,professional'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ], [
            'password.mixed_case' => 'Password must include both upper and lower case letters.',
            'password.numbers' => 'Password must include at least one number.',
            'password.symbols' => 'Password must include at least one symbol.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' => trim($request->input('first_name').' '.$request->input('last_name')),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'archery_status' => $request->input('archery_status'),
            'password' => $request->input('password'),
        ]);

        return response()->json([
            'message' => 'Account created successfully. Please sign in.',
        ], 201);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    public function user(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['user' => null]);
        }

        return response()->json([
            'user' => [
                'name' => $user->name,
                'initials' => $this->formatInitials($user),
            ],
        ]);
    }

    private function formatInitials(User $user): string
    {
        if ($user->first_name && $user->last_name) {
            return strtoupper(substr($user->first_name, 0, 1).substr($user->last_name, 0, 1));
        }

        $parts = preg_split('/\s+/', $user->name, -1, PREG_SPLIT_NO_EMPTY);
        $initials = '';

        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }

        return $initials ?: 'U';
    }
}
