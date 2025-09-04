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

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6'
    ]);

    $user = User::create();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    Auth::login($user);

    return redirect('/dashboard')->with('success', 'Registrasi berhasil!');
}


    public function showLogin() {
        return view ('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
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
        Auth::logout();
        $request->session()->forget('user');
        $request->session()->flush();

        return redirect('/welcome')->with('success', 'Kamu telah logout!');
    }
}
