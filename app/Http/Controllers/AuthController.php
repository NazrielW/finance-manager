<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    // ✅ Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6'
    ]);

    // ✅ Simpan user baru
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    // ✅ Simpan session login
    $request->session()->put('user', $user);

    // ✅ Redirect ke dashboard
    return redirect('/dashboard')->with('success', 'Registrasi berhasil!');
}


    public function showLogin() {
        return view ('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user', $user);
            return redirect('/dashboard');
        } else {
            return back()->withErrors([
                'login' => 'Email atau Password salah!'
            ]);
        }
    }

    public function logout(Request $request) {
        $request->session()->forget('user');
        return redirect('/welcome');
    }
}
