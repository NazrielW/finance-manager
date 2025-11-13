<div class="bg-white rounded-xl shadow-md p-4 w-full">
    <h2 class="text-xl font-semibold mb-3">📝 To-Do List</h2>

    {{-- Form tambah tugas --}}
    <form action="{{ route('todo.store') }}" method="POST" class="flex mb-3">
        @csrf
        <input type="text" name="task" placeholder="Tambah tugas..."
               class="flex-grow border border-gray-300 rounded-l px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
               required>
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700 transition">
            Add
        </button>
    </form>

    {{-- Daftar tugas --}}
    <ul class="space-y-2">
        @foreach ($todos as $todo)
        <li class="flex justify-between items-center border-b pb-1">
            <form action="{{ route('todo.update', $todo->id) }}" method="POST" class="flex items-center">
                @csrf
                @method('PATCH')

                <input type="checkbox" name="completed" value="1" onchange="this.form.submit()"
                       class="h-4 w-4 mr-2 accent-blue-600"
                       {{ $todo->completed ? 'checked' : '' }}>
                <span class="{{ $todo->completed ? 'line-through text-gray-500' : '' }}">
                    {{ $todo->task }}
                </span>
            </form>

            <form action="{{ route('todo.destroy', $todo->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="text-red-500 hover:text-red-700 font-bold">✕</button>
            </form>
        </li>
        @endforeach
    </ul>
</div>
