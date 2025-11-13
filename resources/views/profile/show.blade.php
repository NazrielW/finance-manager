@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Box 1 --}}
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <h6 class="font-semibold mb-2">Your Name</h6>
            <input type="text" class="w-full p-2 rounded text-black mb-3 outline-none">
            <button class="bg-white text-blue-600 font-semibold px-4 py-2 rounded hover:bg-blue-100 transition">
                Change
            </button>
        </div>

        {{-- Box 2 --}}
        <div class="bg-red-500 text-white p-6 rounded-lg shadow">
            <h6 class="font-semibold mb-2">Your Balances</h6>
            <p class="text-lg font-semibold">Rp {{  number_format($balance, 0, ',','.') }}</p>
        </div>

        {{-- Box Panjang (kanan) --}}
        <div class="bg-green-500 text-white p-6 rounded-lg shadow row-span-2 flex flex-col">
            <h6 class="font-semibold mb-4">Change Password</h6>
            <input type="password" placeholder="Old Password" class="w-full p-2 rounded text-black mb-3 outline-none">
            <input type="password" placeholder="New Password" class="w-full p-2 rounded text-black mb-4 outline-none">
            <button class="bg-white text-green-600 font-semibold px-4 py-2 rounded hover:bg-green-100 transition mt-auto">
                Change
            </button>
        </div>

        {{-- Box 3 --}}
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <h6 class="font-semibold mb-2">Your Note</h6>
            <form action="{{ route('note.update') }}" method="POST">
                @csrf
                <textarea name="content" rows="3" class="w-full p-2 rounded text-black mb-3 outline-none"
                    placeholder="Tulis catatan kecilmu di sini">{{ $note->content }}</textarea>
                <button type="submit"
                    class="bg-white text-blue-600 font-semibold px-4 py-2 rounded hover:bg-blue-100 transition">
                    Save
                </button>
            </form>
        </div>

        {{-- Box 4 --}}
        <div class="bg-red-500 text-white p-6 rounded-lg shadow">
            <h6 class="font-semibold mb-2">Your Profile Picture</h6>
            <div class="w-20 h-20 bg-white rounded-full mx-auto"></div>
        </div>


    </div>
@endsection
