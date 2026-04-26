<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthController extends Controller
{
    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        try {
            // 1. Validasi input email dan password
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // 2. Cek apakah email & password cocok
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau Password salah'
                ], 401);
            }

            // 3. Ambil data user & buat token
            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil!',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'role' => $user->role // Menampilkan role user
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal login: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Proses Logout
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Berhasil logout']);
    }
}