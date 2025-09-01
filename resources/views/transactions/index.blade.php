@extends('layouts.app')

@section('title','Daftar Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">Daftar Transaksi</h2>
    <a class="btn btn-success" href="{{ route('transactions.create') }}">+ Tambah</a>
</div>

<div class="card shadow-sm rounded-xl">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td>{{ $t->date->format('Y-m-d') }}</td>
                    <td>
                        <span class="px-2 py-1 rounded text-white {{ $t->type=='pemasukan' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($t->type) }}
                        </span>
                    </td>
                    <td class="fw-bold">{{ number_format($t->amount, 2, ',', '.') }}</td>
                    <td>{{ $t->description }}</td>
                    <td>
                        <a href="{{ route('transactions.edit',$t->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('transactions.destroy',$t->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
