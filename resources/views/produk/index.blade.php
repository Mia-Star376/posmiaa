@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid py-4 px-4">

        <h4 class="mb-5 text-center">Produk</h4>

        <div class="border rounded p-4 bg-white">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;">Create</a>
                @else
                <span></span>
                @endcan

                <form action="{{ route('produk.index') }}" method="GET" class="d-flex" style="max-width: 350px; width: 100%;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control form-control-sm"
                        placeholder="Search nama produk...">
                    <button class="btn btn-outline-secondary btn-sm ms-2" type="submit">
                        Search
                    </button>
                </form>
            </div>

            <div class="rounded-3 overflow-hidden border">
                <table class="table table-sm table-bordered mb-0 align-middle">
                    <thead>
                        <tr class="text-muted text-center">
                            <th scope="col">No</th>
                            <th scope="col">User</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Stok</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $products->firstItem() + $loop->index }}</td>
                            <td>{{ $product->user->name }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$product->foto) }}"
                                     width="70"
                                     class="img-thumbnail">
                            </td>
                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->jenis->nama_jenis ?? '-' }}</td>
                            <td>{{ $product->harga_beli }}</td>
                            <td>{{ $product->harga_jual }}</td>
                            <td>{{ $product->stok }}</td>
                            <td class="text-center">
                                @can('update', $product)
                                <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-warning" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;">Edit</a>
                                @endcan
                                @can('delete', $product)
                                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" style="background-color: #d94f83; border-color: #d94f83; color: #fff;" onclick="return tampilkanHapusProduk(event)">
                                        Hapus
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-muted text-center small">
                                Data tidak tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>

    </div>

    {{-- ================== MODAL KONFIRMASI HAPUS PRODUK ================== --}}
    <div id="modalHapusProduk" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:1060;">
        <div style="background:#fffdf8; border-radius:12px; padding:0; width:320px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.25); text-align:center;">

            <div style="padding:28px 24px 8px;">
                <div style="font-size:16px; font-weight:700; color:#2a2a2a; margin-bottom:6px;">Hapus produk ini?</div>
                <div style="font-size:13px; color:#999;">Data produk akan dihapus permanen dan tidak bisa dikembalikan.</div>
            </div>

            <div style="padding:20px 24px 24px; display:flex; gap:10px;">
                <button type="button" onclick="tutupHapusProduk()"
                    style="flex:1; background:#fff; border:1px solid #f0b8cc; color:#993556; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Tidak
                </button>
                <button type="button" onclick="lanjutkanHapusProduk()"
                    style="flex:1; background:#d4537e; border:none; color:#fff; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Ya, Hapus
                </button>
            </div>

        </div>
    </div>

    <script>
        let formHapusProdukRef = null;

        function tampilkanHapusProduk(e) {
            e.preventDefault();
            formHapusProdukRef = e.target.closest('form');
            document.getElementById('modalHapusProduk').style.display = 'flex';
            return false;
        }

        function tutupHapusProduk() {
            document.getElementById('modalHapusProduk').style.display = 'none';
            formHapusProdukRef = null;
        }

        function lanjutkanHapusProduk() {
            document.getElementById('modalHapusProduk').style.display = 'none';
            if (formHapusProdukRef) {
                formHapusProdukRef.submit();
            }
        }
    </script>

@endsection