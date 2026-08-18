@extends('layouts.app')

@section('title', 'POS')

@section('content')

    <div class="container-fluid py-4 px-4">

        @if (session('errors'))
            <div class="alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif

        <h4 class="mb-4 text-center">
            {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
        </h4>

        <div class="row g-4">

            {{-- ================== PRODUK ================== --}}
            <div class="col-md-6">
                <div class="border rounded p-4 bg-white" style="max-height:70vh; overflow:auto">
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Cari produk..."
                                onkeyup="this.form.submit()">
                        </form>
                    </div>
                    @foreach($products as $product)
                        <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2 g-2 align-items-center">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="col-7">
                                <button class="btn btn-produk w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('storage/'.$product->foto) }}"
                                             alt="Gambar"
                                             class="rounded-circle"
                                             style="width:45px; height:45px; object-fit:cover;">
                                        <div>
                                            <div class="fw-semibold">{{ $product->nama }}</div>
                                            <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                       class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                            </div>

                            <div class="col-2">
                                <button class="btn w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
                                        style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;">+</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>

            {{-- ================== KERANJANG ================== --}}
            <div class="col-md-6">
                <div class="border rounded p-4 bg-white">

                    <div class="rounded-3 overflow-hidden border mb-3">
                        <table class="table table-sm table-bordered mb-0 align-middle">
                            <thead>
                                <tr class="text-muted text-center">
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sale->itemPenjualan as $item)
                                <tr>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>Rp.{{ number_format($item->produk->harga_jual) }}</td>
                                    <td>
                                        {{ $item->kuantitas }}
                                    </td>
                                    <td>Rp. {{ number_format($item->subtotal) }}</td>
                                    <td class="text-center">
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted small">
                                        Keranjang kosong
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <strong class="d-block mb-2">Rp {{ number_format($sale->total_pembayaran) }}</strong>

                    <form method="POST"
                          action="{{ route('penjualan.update', $sale->id) }}"
                          onsubmit="return confirm('Yakin ingin checkout?')" class="mb-2">
                        @csrf
                        @method('PUT')
                        <select name="payment_method" class="form-select mb-2">
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>

                        <button style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;" class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            Checkout
                        </button>
                    </form>

                    @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}"
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-produk w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            Batal Transaksi
                        </button>
                    </form>
                    @endcan

                </div>
            </div>

        </div>

    </div>

<style>
    .btn-produk {
        background-color: #fff;
        border: 1px solid #ffc2d6;
        color: #d94f83;
    }
    .btn-produk:hover {
        background-color: #ffe1ec;
        border-color: #ffc2d6;
        color: #d94f83;
    }
    .btn-produk:active,
    .btn-produk:focus,
    .btn-produk.active {
        background-color: #ff8fb3 !important;
        border-color: #ff8fb3 !important;
        color: #fff !important;
        box-shadow: none !important;
    }
</style>

@endsection