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

    
@include('partials.footer')

@endsection
