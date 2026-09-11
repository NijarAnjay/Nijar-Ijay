@extends('layouts.app')

@section('title', 'Login - POS System')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card border-0 shadow-lg p-4 rounded-4" style="width: 100%; max-width: 400px; background: #ffffff;">
        
        <div class="text-center mb-4 mt-2">
            <div class="bg-primary bg-opacity-10 text-primary d-inline-flex p-3 rounded-circle mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5bea.5.5 0 0 1 .5.5v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5a.5.5 0 0 1 1 0v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-5a.5.5 0 0 1 .5-.5"/>
                </svg>
            </div>
            <h4 class="fw-bold text-dark mb-1">POS System</h4>
            <p class="text-muted small">Silakan masuk ke akun Anda</p>
        </div>

        <form action="{{ route('auth') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-secondary small">Alamat Email</label>
                <input type="email" 
                       name="email" 
                       class="form-control form-control-lg fs-6 @error('email') is-invalid @enderror" 
                       id="email" 
                       placeholder=""
                       value="{{ old('email') }}"
                       required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold text-secondary small">Kata Sandi</label>
                <input type="password" 
                       name="password" 
                       class="form-control form-control-lg fs-6 @error('password') is-invalid @enderror" 
                       id="password" 
                       placeholder=""
                       required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold fs-6 py-2 shadow-sm">
                Masuk
            </button>
        </form>

    </div>
</div>
@endsection
