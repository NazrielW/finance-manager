@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">Daftar Transaksi</h2>
    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-danger">Kembali</a>
        <a href="{{ route('transactions.create') }}" class="btn btn-success">+ Tambah</a>
    </div>
</div>

{{-- Ringkasan Keuangan --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-bg-success">
            <div class="card-body">
                <h6 class="card-title mb-2 text-uppercase">Total Pemasukan (Bulan Ini)</h6>
                <h4 class="fw-bold mb-0">Rp {{ number_format($income, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-bg-danger">
            <div class="card-body">
                <h6 class="card-title mb-2 text-uppercase">Total Pengeluaran (Bulan Ini)</h6>
                <h4 class="fw-bold mb-0">Rp {{ number_format($expense, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-bg-primary">
            <div class="card-body">
                <h6 class="card-title mb-2 text-uppercase">Saldo Sekarang</h6>
                <h4 class="fw-bold mb-0">Rp {{ number_format($balance, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- Filter Data --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('transactions.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="search" class="form-label">Cari Keterangan</label>
                <input type="text" id="search" name="search" placeholder="Contoh: gaji, makan, atm..." 
                       value="{{ request('search') }}" class="form-control">
            </div>
            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary me-1">
                    <i class="bi bi-filter"></i> Filter
                </button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Daftar Transaksi --}}
<table class="table table-bordered table-striped align-middle">
<div class="card shadow-sm">
    <thead class="table-light">
    <div class="card-body">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Sumber</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse($transactions as $date => $sources)
                    @php
                        $rowCount = collect($sources)->flatten(1)->count();
                        $rowIndex = 0;
                    @endphp

                    @foreach($sources as $source => $items)
                        @foreach($items as $t)
                        <tr>
                            <td>{{ $no++ }}</td>

                            {{-- Tampilkan tanggal sekali per grup --}}
                            @if($rowIndex == 0)
                                <td rowspan="{{ $rowCount }}" class="align-middle">
                                    {{ \Carbon\Carbon::parse($date)->translatedFormat('d M Y') }}
                                </td>
                            @endif

                            <td>{{ $source ?? '-' }}</td>
                            <td>{{ $t->category?->name ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $t->type === 'income' ? 'success' : 'danger' }}">
                                    {{ $t->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                            <td>{{ $t->description ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square">edit</i>
                                </a>
                                <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">
                                        <i class="bi bi-trash">Hapus</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php $rowIndex++; @endphp
                        @endforeach
                    @endforeach
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
