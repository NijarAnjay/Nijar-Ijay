@extends('layouts.app')

@section('title', 'Tambah Jenis Produk')

@section('content')
<div class="container my-5">
    <h4>Tambah Jenis Produk</h4>

    <form action="{{ route('jenis.store') }}" method="POST">
        @include('jenis._form')
    </form>
</div>
@endsection
