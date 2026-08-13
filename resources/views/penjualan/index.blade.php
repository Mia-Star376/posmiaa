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
                                <a href="#" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;" onclick="return tampilkanDetail('{{ $sale->id }}', '{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}', '{{ $sale->user->name }}', '{{ number_format($sale->total_pembayaran) }}', '{{ $sale->metode_pembayaran }}', '{{ $sale->status }}')">Detail</a>
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

    <div id="modalDetail" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:1050;">
        <div style="background:#fff; border-radius:14px; padding:0; width:320px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.2);">

            <div style="background:#ff8fb3; padding:16px 20px;">
                <div style="color:#fff; font-size:12px; opacity:.9;">DETAIL TRANSAKSI</div>
                <div style="color:#fff; font-size:18px; font-weight:700;"><span id="dId"></span></div>
            </div>

            <div style="padding:18px 20px;">
                <table style="width:100%; font-size:14px; border-collapse:collapse;">
                    <tr>
                        <td style="color:#999; padding:5px 0;">Tanggal</td>
                        <td style="text-align:right; font-weight:600; color:#333; padding:5px 0;" id="dTanggal"></td>
                    </tr>
                    <tr>
                        <td style="color:#999; padding:5px 0;">Kasir</td>
                        <td style="text-align:right; font-weight:600; color:#333; padding:5px 0;" id="dKasir"></td>
                    </tr>
                    <tr>
                        <td style="color:#999; padding:5px 0;">Metode</td>
                        <td style="text-align:right; font-weight:600; color:#333; padding:5px 0;" id="dMetode"></td>
                    </tr>
                    <tr>
                        <td style="color:#999; padding:5px 0;">Status</td>
                        <td style="text-align:right; padding:5px 0;">
                            <span id="dStatus" style="font-size:12px; font-weight:700; padding:3px 10px; border-radius:12px;"></span>
                        </td>
                    </tr>
                </table>

                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:14px; padding-top:14px; border-top:1px solid #f0f0f0;">
                    <span style="color:#666; font-size:14px; font-weight:600;">Total</span>
                    <span style="color:#db648a; font-size:17px; font-weight:800;">Rp<span id="dTotal"></span></span>
                </div>
            </div>

            <div style="padding:14px 20px 20px;">
                <button onclick="document.getElementById('modalDetail').style.display='none'" style="width:100%; background:#ff8fb3; border:none; color:#fff; padding:9px; border-radius:8px; font-weight:600; cursor:pointer;">Tutup</button>
            </div>

        </div>
    </div>

    <script>
        function tampilkanDetail(id, tanggal, kasir, total, metode, status) {
            document.getElementById('dId').innerText = id;
            document.getElementById('dTanggal').innerText = tanggal;
            document.getElementById('dKasir').innerText = kasir;
            document.getElementById('dTotal').innerText = total;
            document.getElementById('dMetode').innerText = metode;

            const statusEl = document.getElementById('dStatus');
            statusEl.innerText = status;
            if (status === 'COMPLETED') {
                statusEl.style.background = '#e3f9e5';
                statusEl.style.color = '#1f9d55';
            } else {
                statusEl.style.background = '#fff3cd';
                statusEl.style.color = '#b8860b';
            }

            document.getElementById('modalDetail').style.display = 'flex';
            return false;
        }
    </script>

@endsection