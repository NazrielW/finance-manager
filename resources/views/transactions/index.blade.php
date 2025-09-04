@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="align-items-start mb-3">
        <h2 class="fw-bold">Daftar Transaksi</h2>
    </div>
    <div class="align-items-end mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-danger">Kembali</a>
        <a href="{{ route('transactions.create') }}" class="btn btn-success">+ Tambah</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="badge bg-{{ $t->type == 'pemasukan' ? 'success' : 'danger' }}">
                            {{ ucfirst($t->type) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                    <td>{{ $t->description }}</td>
                    <td>{{ $t->date->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
