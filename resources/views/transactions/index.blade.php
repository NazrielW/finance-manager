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

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-bg-success">
            <div class="card-body">
                <h5 class="card-title">Total Pemasukan (Bulan Ini)</h5>
                <p class="fs-4 fw-bold">Rp {{ number_format($income, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-bg-danger">
            <div class="card-body">
                <h5 class="card-title">Total Pengeluaran (Bulan Ini)</h5>
                <p class="fs-4 fw-bold">Rp {{ number_format($expense, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-bg-primary">
            <div class="card-body">
                <h5 class="card-title">Saldo</h5>
                <p class="fs-4 fw-bold">Rp {{ number_format($balance, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Filter --}}
<form action="{{ route('transactions.index') }}" method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
    </div>
    <div class="col-md-3">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
    </div>
    <div class="col-md-3">
        <select name="category_id" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $c)
            <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <input type="text" name="search" placeholder="Cari keterangan..." value="{{ request('search') }}" class="form-control">
    </div>
    <div class="col-md-12 text-end mt-2">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

{{-- Tabel --}}
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Sumber</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
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

                            {{-- tampilkan tanggal sekali saja --}}
                            @if($rowIndex == 0)
                                <td rowspan="{{ $rowCount }}" class="align-middle">
                                    {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                                </td>
                            @endif

                            <td>{{ $source ?? 'Tidak ada' }}</td>
                            <td>{{ $t->category?->name ?? 'Tidak ada kategori' }}</td>
                            <td>
                                <span class="badge bg-{{ $t->type == 'income' ? 'success' : 'danger' }}">
                                    {{ $t->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                            <td>{{ $t->description }}</td>
                            <td>
                                <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @php $rowIndex++; @endphp
                        @endforeach
                    @endforeach
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
