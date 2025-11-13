<nav class="bg-orange-500 px-4 py-3 justify-between flex">
    <div class="">
        <a href="{{ route('dashboard') }}" class="text-white bold text-4xl text-decoration-none">Fishman</a>
    </div>

    @if (session()->has('user'))
        <div class="flex items-center space-x-4">
            <a href="{{ route('profile.show') }}">
                <img src="" alt="ikan" class="bg-black w-12 h-12 rounded-full">
            </a>
        </div>
    @endif
</nav>