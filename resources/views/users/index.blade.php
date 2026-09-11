@extends('layouts.app') 

@section('title', 'Users Management') 

@section('content') 
@include('layouts.navbar') 

<div class="container my-5">
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h2 class="text-dark fw-bold m-0 fs-3 tracking-tight">Manajemen Users</h2>
            <p class="text-muted mb-0 small">Kelola data pengguna, peran, dan hak akses sistem.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Tambah User Baru
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.users') }}" method="GET" class="row g-2 align-items-center"> 
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted ps-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               class="form-control border-start-0 ps-0 bg-transparent" 
                               placeholder="Cari nama atau email...">
                        @if(request('search'))
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary border-start-0 text-muted" type="button">
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
                        <th scope="col" class="py-3">Pengguna</th> 
                        <th scope="col" class="py-3">Email</th> 
                        <th scope="col" class="py-3" style="width: 15%">Role</th> 
                        <th scope="col" class="text-end pe-4 py-3" style="width: 20%">Aksi</th> 
                    </tr> 
                </thead> 
                <tbody class="border-top-0"> 
                    @forelse($users as $user) 
                    <tr> 
                        <td class="ps-4 fw-semibold text-muted fs-7">
                            {{ $users->firstItem() + $loop->index }}
                        </td> 
                        
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff&rounded=true" 
                                     alt="{{ $user->name }}" 
                                     class="rounded-circle me-3" 
                                     width="38" 
                                     height="38">
                                <div>
                                    <div class="fw-bold text-dark">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td> 
                        
                        <td class="text-secondary">{{ $user->email }}</td> 
                        
                        <td>
                            @php
                                $roleName = strtolower($user->role->name ?? '');
                                $badgeClass = match($roleName) {
                                    'admin', 'administrator' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                    'kasir', 'cashier' => 'bg-success-subtle text-success border border-success-subtle',
                                    default => 'bg-primary-subtle text-primary border border-primary-subtle',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} px-3 py-2 rounded-pill fw-medium text-capitalize">
                                <i class="bi bi-shield-check me-1"></i> {{ $user->role->name ?? 'No Role' }}
                            </span>
                        </td> 

                        <td class="text-end pe-4"> 
                            <div class="btn-group gap-1">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="btn btn-sm btn-light text-warning border shadow-2xs rounded-2 px-2.5" 
                                   data-bs-toggle="tooltip" 
                                   title="Edit User"> 
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a> 
                                
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"> 
                                    @csrf 
                                    @method('DELETE') 
                                    <button class="btn btn-sm btn-light text-danger border shadow-2xs rounded-2 px-2.5" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"> 
                                        <i class="bi bi-trash"></i> Hapus
                                    </button> 
                                </form> 
                            </div>
                        </td> 
                    </tr> 
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            <span>Data pengguna tidak ditemukan.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody> 
            </table> 
        </div>
    </div>

    <div class="d-flex justify-content-end">
        {{ $users->links() }} 
    </div>
</div>
@endsection
