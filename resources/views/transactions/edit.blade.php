@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="fw-bold mb-4">Edit Transaksi</h2>

        {{-- Tampilkan pesan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Edit Transaksi --}}
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            {{-- Jenis Transaksi --}}
            <div class="mb-3">
                <label class="form-label">Jenis Transaksi</label>
                <select name="type" class="form-select" required>
                    <option value="income" {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ old('category_id', $transaction->category_id) == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Transaksi</label>
                <input type="text" name="title" class="form-control"
                       placeholder="Contoh: Gaji Bulanan, Beli Makan, dll"
                       value="{{ old('title', $transaction->title) }}">
            </div>

            {{-- Jumlah Uang --}}
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" 
                       name="amount" 
                       step="0.01" 
                       min="0"
                       class="form-control @error('amount') is-invalid @enderror"
                       value="{{ old('amount', $transaction->amount) }}" 
                       placeholder="Masukkan jumlah transaksi" 
                       required
                       autofocus>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" 
                       name="description" 
                       class="form-control @error('description') is-invalid @enderror"
                       value="{{ old('description', $transaction->description) }}" 
                       placeholder="Contoh: beli buku atau gaji bulan ini">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" 
                       name="date" 
                       class="form-control @error('date') is-invalid @enderror"
                       value="{{ old('date', $transaction->date ? $transaction->date->format('Y-m-d') : now()->format('Y-m-d')) }}"
                       required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Sumber Transaksi (opsional) --}}
            <div class="mb-3">
                <label class="form-label">Sumber</label>
                <input type="text" 
                       name="source" 
                       class="form-control @error('source') is-invalid @enderror"
                       value="{{ old('source', $transaction->source) }}" 
                       placeholder="Contoh: Shopee, Gaji, ATM, dll">
                @error('source')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@include('partials.footer')
