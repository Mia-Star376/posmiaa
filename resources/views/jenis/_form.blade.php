@csrf

<div class="mb-4">
    <label class="form-label fw-semibold">Nama Jenis</label>
    <input type="text" name="nama_jenis"
           class="form-control @error('nama_jenis') is-invalid @enderror"
           value="{{ old('nama_jenis', $jenis->nama_jenis ?? '') }}">
    @error('nama_jenis')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="text-center">
    <button class="btn btn-pink" type="submit">Simpan</button>
    <a href="{{ route('jenis.index') }}" class="btn btn-pink-outline">Kembali</a>
</div>

<style>
    .btn-pink {
        background-color: #d63384;
        border-color: #d63384;
        color: #fff;
    }
    .btn-pink:hover {
        background-color: #b02a6b;
        border-color: #b02a6b;
        color: #fff;
    }
    .btn-pink-outline {
        background-color: transparent;
        border: 1px solid #d63384;
        color: #d63384;
    }
    .btn-pink-outline:hover {
        background-color: #d63384;
        color: #fff;
    }
</style>