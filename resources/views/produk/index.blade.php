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
                                    <button class="btn btn-sm btn-danger" style="background-color: #d94f83; border-color: #d94f83; color: #fff;" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
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

@endsection