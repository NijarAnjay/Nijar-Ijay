@extends('layouts.app') 

@section('title', 'Manajemen Penjualan') 

@section('content') 
@include('layouts.navbar') 

<div class="container my-5">
    @if (session('errors')) 
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert"> 
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                <div>{{ session('errors') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
    @endif 

    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h2 class="text-dark fw-bold m-0 fs-3 tracking-tight">Halaman Penjualan</h2>
            <p class="text-muted mb-0 small">Kelola riwayat transaksi, metode pembayaran, dan status penjualan.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Tambah Penjualan
            </a> 
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('penjualan.index') }}" method="GET" class="row g-2 align-items-center"> 
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted ps-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               class="form-control border-start-0 ps-0 bg-transparent" 
                               placeholder="Cari data penjualan...">
                        @if(request('search'))
                            <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary border-start-0 text-muted" type="button">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        @endif
                        <button class="btn btn-primary px-4 fw-semibold" type="submit">Cari</button> 
                    </div> 
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0"> 
                <thead class="bg-light text-uppercase fs-7 text-secondary fw-bold border-bottom"> 
                    <tr> 
                        <th scope="col" class="ps-4 py-3" style="width: 5%">#</th> 
                        <th scope="col" class="py-3">Tanggal Transaksi</th> 
                        <th scope="col" class="py-3">Kasir</th> 
                        <th scope="col" class="py-3">Total Pembayaran</th> 
                        <th scope="col" class="py-3">Metode</th> 
                        <th scope="col" class="py-3">Status</th> 
                        <th scope="col" class="text-end pe-4 py-3" style="width: 20%">Aksi</th> 
                    </tr> 
                </thead> 
                <tbody class="border-top-0"> 
                    @forelse($sales as $sale) 
                    <tr> 
                        <td class="ps-4 fw-semibold text-muted fs-7">
                            {{ $sales->firstItem() + $loop->index }}
                        </td> 

                        <td class="text-secondary">
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                        </td> 

                        <td>
                            <span class="badge bg-light text-secondary border px-2.5 py-1.5 rounded-pill fw-normal">
                                <i class="bi bi-person me-1"></i> {{ $sale->user->name ?? 'System' }}
                            </span>
                        </td> 

                        <td class="fw-bold text-dark">
                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                        </td> 

                        <td>
                            <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-pill fw-medium text-uppercase">
                                <i class="bi bi-credit-card me-1 text-muted"></i> {{ $sale->metode_pembayaran }}
                            </span>
                        </td> 

                        <td> 
                            @if(strtoupper($sale->status) == 'OPEN')
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-medium">
                                    <i class="bi bi-clock-history me-1"></i> OPEN
                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-medium">
                                    <i class="bi bi-check-circle me-1"></i> {{ $sale->status }}
                                </span>
                            @endif
                        </td> 

                        <td class="text-end pe-4"> 
                            <div class="btn-group gap-1">
                                <a href="{{ route('penjualan.show', $sale->id) }}" 
                                   class="btn btn-sm btn-light text-primary border shadow-2xs rounded-2 px-2.5" 
                                   title="Detail"> 
                                    <i class="bi bi-eye"></i> Detail
                                </a> 

                                {{-- Hanya Admin + status OPEN --}} 
                                @if( auth()->check() && strtolower(auth()->user()->role->name ?? '') == 'admin' && strtoupper($sale->status) == 'OPEN' ) 
                                    <a href="{{ route('penjualan.edit', $sale->id) }}" 
                                       class="btn btn-sm btn-light text-warning border shadow-2xs rounded-2 px-2.5" 
                                       title="Edit"> 
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a> 

                                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="d-inline"> 
                                        @csrf 
                                        @method('DELETE') 
                                        <button class="btn btn-sm btn-light text-danger border shadow-2xs rounded-2 px-2.5" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus penjualan ini?')"> 
                                            <i class="bi bi-trash"></i> Hapus
                                        </button> 
                                    </form> 
                                @endif 
                            </div>
                        </td> 
                    </tr> 
                    @empty 
                    <tr> 
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-receipt fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            <span>Data penjualan tidak ditemukan.</span>
                        </td> 
                    </tr> 
                    @endforelse 
                </tbody> 
            </table> 
        </div>
    </div>

    <div class="d-flex justify-content-end">
        {{ $sales->links() }} 
    </div>
</div>
@endsection
