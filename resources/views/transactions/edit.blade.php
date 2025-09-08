@extends('layouts.app')

@section('title','Edit Transaksi')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="fw-bold mb-3">Edit Transaksi</h2>
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select name="type" class="form-select">
                    <option value="pemasukan" {{ $transaction->type == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="pengeluaran" {{ $transaction->type == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="amount" step="0.01" class="form-control" value="{{ $transaction->amount }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="description" class="form-control" value="{{ $transaction->description }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ $transaction->date->format('Y-m-d') }}">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

@include('partials.footer')