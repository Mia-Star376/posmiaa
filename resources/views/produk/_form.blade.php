@csrf

<div class="container-fluid py-5 px-4">
    <div class="row justify-content-center mt-5 pt-5">
        <div class="col-lg-10">

            <h4 class="mb-4 text-center">{{ isset($produk) ? 'Edit Produk' : 'Tambah Produk' }}</h4>

            <div class="border rounded p-5 bg-white">

                @if (!empty($produk->foto))
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Saat Ini</label><br>
                        <img src="{{ asset('storage/' . $produk->foto) }}"
                             width="150"
                             class="img-thumbnail">
                    </div>
                @endif

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Gambar</label>
                        <input type="file"
                               name="foto"
                               onchange="previewImage(this)"
                               class="form-control @error('foto') is-invalid @enderror">
                        @error('foto')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Preview Foto</label><br>
                        <img id="preview" class="img-thumbnail mt-2" style="display:none" width="150">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $produk->nama ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Produk</label>
                    <select name="jenis_id"
                            class="form-select @error('jenis_id') is-invalid @enderror">
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->id }}"
                                {{ old('jenis_id', $produk->jenis_id ?? '') == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_id')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga Beli</label>
                        <input type="number" name="purchase_price"
                               class="form-control @error('purchase_price') is-invalid @enderror"
                               value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
                        @error('purchase_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga Jual</label>
                        <input type="number" name="selling_price"
                               class="form-control @error('selling_price') is-invalid @enderror"
                               value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
                        @error('selling_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Stok</label>
                    <input type="number" name="stock"
                           class="form-control @error('stock') is-invalid @enderror"
                           value="{{ old('stock', $produk->stok ?? '') }}">
                    @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-pink" type="submit">Simpan</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-pink-outline">Kembali</a>
                </div>

            </div>
        </div>
    </div>
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

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>