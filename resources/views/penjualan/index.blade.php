@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid py-4 px-4">

        <h4 class="mb-5 text-center">Penjualan</h4>


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
                                <a href="#" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;"
                                   onclick="return tampilkanDetail(
                                       '{{ $sale->id }}',
                                       '{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}',
                                       '{{ $sale->user->name }}',
                                       '{{ number_format($sale->total_pembayaran) }}',
                                       '{{ $sale->metode_pembayaran }}',
                                       '{{ $sale->status }}',
                                       '{{ number_format($sale->uang_diterima ?? 0) }}',
                                       '{{ number_format($sale->kembalian ?? 0) }}'
                                   )">Detail</a>
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
    <div style="background:#fffdf8; border-radius:4px; padding:0; width:300px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.25); font-family:'Courier New', Consolas, monospace;">

        <div style="padding:20px 20px 4px; text-align:center;">
            <div style="font-size:15px; font-weight:700; letter-spacing:2px; color:#2a2a2a;">POINT OF SALE</div>
            <div style="font-size:11px; color:#d4537e; letter-spacing:1px; margin-top:4px;">TRX #<span id="dId"></span></div>
            <span id="dStatus" style="display:inline-block; margin-top:10px; font-size:11px; font-weight:700; padding:3px 10px; border-radius:3px; letter-spacing:1px;"></span>
        </div>

        <div style="padding:14px 20px 0;">
            <hr style="border:none; border-top:1.5px dashed #f0b8cc; margin:10px 0;">

            <table style="width:100%; font-size:12.5px; border-collapse:collapse;">
                <tr>
                    <td style="color:#999; padding:4px 0;">Tanggal</td>
                    <td style="text-align:right; font-weight:700; color:#2a2a2a; padding:4px 0;" id="dTanggal"></td>
                </tr>
                <tr>
                    <td style="color:#999; padding:4px 0;">Kasir</td>
                    <td style="text-align:right; font-weight:700; color:#2a2a2a; padding:4px 0;" id="dKasir"></td>
                </tr>
                <tr>
                    <td style="color:#999; padding:4px 0;">Metode</td>
                    <td style="text-align:right; font-weight:700; color:#2a2a2a; padding:4px 0;" id="dMetode"></td>
                </tr>
            </table>

            <!-- Box QRIS -->
            <div id="dQrisBox" style="display:none; text-align:center; margin-top:12px;">
                <img id="dQrisImg" src="" alt="QRIS" style="width:120px; height:120px; border:1px solid #f0b8cc; padding:6px; border-radius:4px;">
                <div style="font-size:10px; color:#999; letter-spacing:1px; margin-top:4px;">SCAN QRIS</div>
            </div>

            <!-- Box Cash -->
            <div id="dCashBox" style="display:none; margin-top:12px; background:#fbeef3; border-radius:4px; padding:10px 12px;">
                <div style="display:flex; justify-content:space-between; font-size:12px; color:#666;">
                    <span>Uang Diterima</span>
                    <span id="dUangDiterima" style="font-weight:700; color:#2a2a2a;"></span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:12px; color:#666; margin-top:4px;">
                    <span>Kembalian</span>
                    <span id="dKembalian" style="font-weight:700; color:#d4537e;"></span>
                </div>
            </div>

            <hr style="border:none; border-top:1.5px dashed #f0b8cc; margin:10px 0;">

            <div style="display:flex; justify-content:space-between; align-items:baseline; margin-bottom:16px;">
                <span style="color:#993556; font-size:13px; font-weight:700; letter-spacing:1px;">TOTAL</span>
                <span style="color:#d4537e; font-size:20px; font-weight:800;">Rp<span id="dTotal"></span></span>
            </div>
        </div>

        <div style="padding:0 20px 20px;">
            <button onclick="document.getElementById('modalDetail').style.display='none'" style="width:100%; background:#d4537e; border:none; color:#fff; padding:10px; border-radius:4px; font-family:inherit; font-size:13px; font-weight:700; letter-spacing:1px; cursor:pointer;">TUTUP</button>
        </div>

    </div>
</div>

<script>
    function tampilkanDetail(id, tanggal, kasir, total, metode, status, uangDiterima, kembalian) {
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
            statusEl.style.border = '1px solid #1f9d55';
        } else {
            statusEl.style.background = '#fdf3dc';
            statusEl.style.color = '#a67a12';
            statusEl.style.border = '1px solid #a67a12';
        }

        const qrisBox = document.getElementById('dQrisBox');
        const cashBox = document.getElementById('dCashBox');
        qrisBox.style.display = 'none';
        cashBox.style.display = 'none';

        if (metode === 'QRIS') {
            const isiQr = 'TRX-' + id + '|' + total;
            document.getElementById('dQrisImg').src =
                'https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=' + encodeURIComponent(isiQr);
            qrisBox.style.display = 'block';
        } else if (metode === 'CASH') {
            document.getElementById('dUangDiterima').innerText = 'Rp ' + uangDiterima;
            document.getElementById('dKembalian').innerText = 'Rp ' + kembalian;
            cashBox.style.display = 'block';
        }

        document.getElementById('modalDetail').style.display = 'flex';
        return false;
    }
</script>

@endsection