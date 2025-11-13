<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;
use App\Models\Note;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->session()->get('user');

        $dbUser = User::with('balance')->find($user->id);

        // Ambil nilai balance (kalau tidak ada → 0)
        $balance = $dbUser->balance->amount ?? 0;

        // Ambil atau buat note user
        $note = Note::firstOrCreate(
            ['user_id' => $user->id],
            ['content' => '']
        );

        return view('profile.show', compact('user', 'balance', 'note'));
    }
    public function updateBalance(Request $request)
    {
        $user = $request->session()->get('user');

        $request->validate([
            'balance' => 'required|numeric|min:0',
        ]);

        Balance::updateOrCreate(
            ['user_id' => $user->id],
            ['amount' => $request->balance]
        );

        return redirect()->back()->with('success', 'Saldo berhasil diperbarui!');
    }

    public function update(Request $request)
    {
        $sessionUser = $request->session()->get('user');
        $dbUser = User::find($sessionUser->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dbUser->id,
        ]);

        $dbUser->update($request->only('name', 'email'));

        // perbarui session user
        $request->session()->put('user', $dbUser);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
