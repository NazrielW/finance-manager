@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="text-center py-5">
    <h2 class="fw-bold text-2xl mb-3">Welcome to Finance Manager</h2>
    <p class="text-muted">Kelola pemasukan dan pengeluaranmu dengan mudah 🚀</p>
    <a href="{{ route('transactions.index') }}" class="btn btn-primary mt-3">Lihat Transaksi</a>
</div>
@endsection
