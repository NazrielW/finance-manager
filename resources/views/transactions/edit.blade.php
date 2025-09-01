@extends('layouts.app')

@section('title','Tambah Transaksi')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="fw-bold mb-3">Tambah Transaksi</h2>
        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-3">
            @csrf
            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select name="type" class="form-select">
                    <option value="pemasukan">Pemasukan</option>
                    <option value="pengeluaran">Pengeluaran</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="amount" step="0.01" class="form-control" placeholder="100000">
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="description" class="form-control" placeholder="Contoh: beli buku">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
