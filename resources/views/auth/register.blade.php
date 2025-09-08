@extends('layouts.app')

@section('title','Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow rounded-xl">
            <div class="card-body">
                <h2 class="fw-bold mb-3 text-center">Register</h2>
                <form action="{{ route('register') }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

@endsection
