<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', session('user')->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('todo.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        Todo::create([
            'user_id' => session('user')->id,
            'task' => $request->task,
            'completed' => $request->has('completed') ? true : false,
        ]);

        return back()->with('success', 'Task berhasil ditambahkan!');
    }

    public function update(Todo $todo, Request $request)
    {
        $todo->update([
            'completed' => $request->has('completed') ? true : false,
        ]);

        return back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return back();
    }
}
