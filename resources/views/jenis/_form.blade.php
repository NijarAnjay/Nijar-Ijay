@csrf

<div class="mb-2">
    <label>Nama Jenis</label><br>
    <input type="text" name="nama"
            class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $jenis->nama ?? '') }}">
    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mt-3 d-flex gap-2">
    <button class="btn btn-success" type="submit">
        Submit
    </button>

    <a href="{{ route('jenis.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>
