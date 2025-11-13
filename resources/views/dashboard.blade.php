@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="card shadow-sm">
    <div class="card-body my-2">
        <h2 class="fw-bold">Selamat datang kembali {{ session('user.name') }}!</h2>
        <p class="text-muted mb-3">Kelola pemasukan dan pengeluaranmu dengan mudah.</p>
        <a href="{{ route('transactions.index') }}" class="btn btn-primary">Lihat Transaksi</a>
    </div>
</div>

@include('widgets.todo')

<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-8 rounded-md shadow-md mb-4 max-w-md mt-4">
    <h3 class="font-semibold text-lg mb-1">Catatan Kamu</h3>
    <p class="text-sm whitespace-pre-line">
        {{ $note->content ? $note->content : 'Belum ada catatan, tambahkan di halaman profil.' }}
    </p>
</div>

@include('widgets.chart')

@include('widgets.donut')

@include('partials.footer')

@endsection
