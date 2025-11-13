<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function edit(Request $request)
    {
        $note = Note::firstOrCreate(
            ['user_id' => session('user')->id],
            ['content' => '']
        );

        return view('profile.note', compact('note'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $note = Note::updateOrCreate(
            ['user_id' => session('user')->id],
            ['content' => $request->content]
        );

        return redirect()->route('profile.show')->with('success', 'Note berhasil disimpan!');
    }
}
