<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ==== REGISTER (WEB) ====
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Simpan user baru (password di-hash)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Balance::create([
            'user_id' => $user->id,
            'amount' => 0
        ]);

        // Simpan user ke session (manual)
        $request->session()->put('user', $user);

        return redirect('/dashboard')->with('success', 'Registrasi berhasil!');
    }

    // ==== LOGIN (WEB) ====
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        // Cek password (pakai Hash::check)
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        // Simpan user ke session (manual)
        $request->session()->put('user', $user);

        return redirect('/dashboard')->with('success', 'Login berhasil!');
    }

    // ==== LOGOUT (WEB) ====
    public function logout(Request $request)
    {
        $request->session()->forget('user'); // hapus user
        $request->session()->flush();        // bersihkan semua session

        return redirect('/welcome')->with('success', 'Kamu telah logout!');
    }


    // ==== API AUTH ====

    public function apiRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // bikin token Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function apiLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // hapus token lama biar gak numpuk
        $user->tokens()->delete();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function apiLogout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
    