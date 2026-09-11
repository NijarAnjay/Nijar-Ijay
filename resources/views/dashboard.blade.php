@extends('layouts.app') 

@section('title', 'Dashboard Ringkasan') 

@section('content') 
@include('layouts.navbar') 

<div class="container my-5"> 
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h2 class="text-dark fw-bold m-0 fs-3 tracking-tight">Ringkasan Hari Ini</h2>
            <p class="text-muted mb-0 small">Pantau performa penjualan, transaksi, serta kondisi inventori barang.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-2xs fw-normal fs-6">
                <i class="bi bi-calendar3 me-2 text-primary"></i>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </span>
        </div>
    </div>

    @can('viewAny', App\Models\User::class) 
        <div class="row g-3 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary-subtle text-primary p-3 rounded-4 me-3">
                            <i class="bi bi-cash-stack fs-3"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-semibold fs-7">Total Penjualan</div>
                            <h4 class="fw-bold text-dark mb-0">Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-success-subtle text-success p-3 rounded-4 me-3">
                            <i class="bi bi-receipt fs-3"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-semibold fs-7">Total Transaksi</div>
                            <h4 class="fw-bold text-dark mb-0">
                                {{ $ringkasan['total_transaksi'] }} <span class="fs-7 text-muted fw-normal">Selesai</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-info-subtle text-info p-3 rounded-4 me-3">
                            <i class="bi bi-wallet2 fs-3"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-semibold fs-7">Pembayaran Tunai</div>
                            <h4 class="fw-bold text-dark mb-0">Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-warning-subtle text-warning p-3 rounded-4 me-3">
                            <i class="bi bi-credit-card fs-3"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-semibold fs-7">Non-Tunai</div>
                            <h4 class="fw-bold text-dark mb-0">Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan 

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2 fs-5"></i>
                    <h5 class="mb-0 text-dark fw-bold fs-6">Status Inventori Krisis</h5>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-6 border-end p-3">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-circle p-2 me-2">
                                    <i class="bi bi-box-seam"></i>
                                </span>
                                <h6 class="fw-bold text-dark mb-0 fs-7">Produk Stok Rendah</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light text-uppercase fs-7 text-secondary fw-bold border-bottom">
                                        <tr>
                                            <th class="py-2">#</th>
                                            <th class="py-2">Nama</th>
                                            <th class="text-end py-2">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top-0 fs-7">
                                        @forelse ($produkStokRendah as $index => $produk) 
                                            <tr>
                                                <td class="text-muted fw-semibold">{{ $produkStokRendah->firstItem() + $index }}</td>
                                                <td class="fw-bold text-dark text-truncate" style="max-width: 130px;">{{ $produk->nama }}</td>
                                                <td class="text-end">
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1 rounded-pill">
                                                        {{ $produk->stok }} Pcs
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty 
                                            <tr>
                                                <td colspan="3" class="text-muted text-center py-4">Semua stok aman.</td>
                                            </tr>
                                        @endforelse 
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 fs-sm d-flex justify-content-end">{{ $produkStokRendah->links() }}</div>
                        </div>

                        <div class="col-md-6 p-3">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-circle p-2 me-2">
                                    <i class="bi bi-x-circle"></i>
                                </span>
                                <h6 class="fw-bold text-dark mb-0 fs-7">Produk Habis</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light text-uppercase fs-7 text-secondary fw-bold border-bottom">
                                        <tr>
                                            <th class="py-2">#</th>
                                            <th class="py-2">Nama</th>
                                            <th class="text-end py-2">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top-0 fs-7">
                                        @forelse ($produkStokHabis as $index => $produk) 
                                            <tr>
                                                <td class="text-muted fw-semibold">{{ $produkStokHabis->firstItem() + $index }}</td>
                                                <td class="fw-bold text-dark text-truncate" style="max-width: 130px;">{{ $produk->nama }}</td>
                                                <td class="text-end">
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 rounded-pill">
                                                        0 Pcs
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty 
                                            <tr>
                                                <td colspan="3" class="text-muted text-center py-4">Tidak ada produk habis.</td>
                                            </tr>
                                        @endforelse 
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 fs-sm d-flex justify-content-end">{{ $produkStokHabis->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                    <i class="bi bi-trophy-fill text-warning me-2 fs-5"></i>
                    <h5 class="mb-0 text-dark fw-bold fs-6">Produk Terlaris</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-uppercase fs-7 text-secondary fw-bold border-bottom">
                                <tr>
                                    <th class="ps-3 py-3">Nama</th>
                                    <th class="text-center py-3">Sisa</th>
                                    <th class="text-end pe-3 py-3">Terjual</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0 fs-7">
                                @forelse ($produkTerlaris as $produk) 
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark text-truncate" style="max-width: 120px;">
                                            {{ $produk->nama }}
                                        </td>
                                        <td class="text-center text-muted">
                                            {{ $produk->stok }}
                                        </td>
                                        <td class="text-end pe-3">
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fw-semibold">
                                                <i class="bi bi-graph-up-arrow me-1"></i>{{ $produk->total_terjual }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty 
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-1 text-secondary opacity-50"></i>
                                            <span>Belum ada data penjualan.</span>
                                        </td>
                                    </tr>
                                @endforelse 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
