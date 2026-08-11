@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid py-4 px-4">

        <h4 class="mb-5 text-center">Penjualan</h4>

        @if(session('errors'))
            <div class="alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif

        <div class="border rounded p-4 bg-white">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <a href="{{ route('penjualan.create') }}" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;">Create</a>

                <form action="{{ route('penjualan.index') }}" method="GET" class="d-flex" style="max-width: 350px; width: 100%;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request()->search }}"
                        class="form-control form-control-sm"
                        placeholder="Search penjualan">
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
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Kasir</th>
                            <th scope="col">Total Pembayaran</th>
                            <th scope="col">Metode Pembayaran</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sales->firstItem() + $loop->index }}</td>
                            <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>Rp.{{ number_format($sale->total_pembayaran) }}</td>
                            <td>{{ $sale->metode_pembayaran }}</td>
                            <td>{{ $sale->status }}</td>
                            <td class="text-center">
                                <a href="" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;">Detail</a>
                                @can('view', $sale)
                                <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-sm" style="background-color: #db648a; border-color: #db648a; color: #fff;">Edit</a>
                                @endcan
                                @can('delete', $sale)
                                <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                        Hapus
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted text-center small">
                                Data tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $sales->links() }}
            </div>

        </div>

    </div>

@endsection