@extends('layouts.app')

@section('title', 'Manajemen Jenis Produk')

@section('content')
@include('layouts.navbar')

<div class="container my-5">
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h2 class="text-dark fw-bold m-0 fs-3 tracking-tight">Halaman Jenis Produk</h2>
            <p class="text-muted mb-0 small">Kelola jenis/kategori produk sebelum menambahkan produk.</p>
        </div>
        <div class="col-md-6 text-md-end">
            @can('create', App\Models\Jenis::class)
                <a href="{{ route('jenis.create') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-semibold">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Jenis
                </a>
            @endcan
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('jenis.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted ps-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control border-start-0 ps-0 bg-transparent"
                               placeholder="Cari nama jenis...">
                        @if(request('search'))
                            <a href="{{ route('jenis.index') }}" class="btn btn-outline-secondary border-start-0 text-muted" type="button">
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
                        <th scope="col" class="py-3">Nama Jenis</th>
                        <th scope="col" class="py-3" style="width: 15%">Jumlah Produk</th>
                        <th scope="col" class="text-end pe-4 py-3" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($jenis as $item)
                    <tr>
                        <td class="ps-4 fw-semibold text-muted fs-7">
                            {{ $jenis->firstItem() + $loop->index }}
                        </td>

                        <td class="fw-bold text-dark">{{ $item->nama }}</td>

                        <td>
                            <span class="badge bg-light text-secondary border px-2.5 py-1.5 rounded-pill fw-normal">
                                {{ $item->produk_count }} Produk
                            </span>
                        </td>

                        <td class="text-end pe-4">
                            <div class="btn-group gap-1">
                                @can('view', $item)
                                    <a href="{{ route('jenis.show', $item) }}"
                                       class="btn btn-sm btn-light text-primary border shadow-2xs rounded-2 px-2.5"
                                       title="Detail">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                @endcan

                                @can('update', $item)
                                    <a href="{{ route('jenis.edit', $item) }}"
                                       class="btn btn-sm btn-light text-warning border shadow-2xs rounded-2 px-2.5"
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                @endcan

                                @can('delete', $item)
                                    <form action="{{ route('jenis.destroy', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light text-danger border shadow-2xs rounded-2 px-2.5"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jenis ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-tags fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            <span>Data jenis produk tidak ditemukan.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        {{ $jenis->links() }}
    </div>
</div>
@endsection
