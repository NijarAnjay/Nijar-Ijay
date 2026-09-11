@extends('layouts.app')

@section('title', 'Detail Jenis Produk')

@section('content')

<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow" style="width: 28rem;">
        <div class="card-body">
            <h4 class="card-title text-center mb-3">
                {{ $jenis->nama }}
            </h4>

            <p class="card-text text-center">
                <strong>Jumlah Produk:</strong> {{ $jenis->produk()->count() }}
            </p>

            <div class="text-center mt-3">
                <a href="{{ route('jenis.index') }}" class="btn btn-secondary btn-sm">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
