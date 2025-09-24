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
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" 
                            {{ old('category_id', $transaction->category_id ?? '') == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="amount" step="0.01" class="form-control" placeholder="100000" value="{{ old('amount') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="description" class="form-control" placeholder="Contoh: beli buku" value="{{ old('description') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>

            <div class="mb-3">
                <label for="form-label">Sumber</label>
                <input type="text" name="source" class="form-control" value="{{ old('source') }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

@include('partials.footer')