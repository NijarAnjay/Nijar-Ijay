@extends('layouts.app')

@section('title', 'Edit Jenis Produk')

@section('content')
<div class="container my-5">
    <h4>Edit Jenis Produk</h4>

    <form action="{{ route('jenis.update', $jenis) }}" method="POST">
        @method('PUT')
        @include('jenis._form')
    </form>
</div>
@endsection
