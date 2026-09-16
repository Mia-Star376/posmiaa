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
                        @php
                            $itemsForModal = [];
                            foreach ($sale->itemPenjualan as $i) {
                                $itemsForModal[] = [
                                    'nama' => $i->produk->nama ?? 'Produk dihapus',
                                    'kuantitas' => $i->kuantitas,
                                    'subtotal' => number_format($i->subtotal),
                                ];
                            }
                        @endphp
                        <tr>
                            <td>{{ $sales->firstItem() + $loop->index }}</td>
                            <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>Rp.{{ number_format($sale->total_pembayaran) }}</td>
                            <td>{{ $sale->metode_pembayaran }}</td>
                            <td>{{ $sale->status }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;"
                                   data-id="{{ $sale->id }}"
                                   data-tanggal="{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}"
                                   data-kasir="{{ $sale->user->name }}"
                                   data-total="{{ number_format($sale->total_pembayaran) }}"
                                   data-metode="{{ $sale->metode_pembayaran }}"
                                   data-status="{{ $sale->status }}"
                                   data-uang-diterima="{{ number_format($sale->uang_diterima ?? 0) }}"
                                   data-kembalian="{{ number_format($sale->kembalian ?? 0) }}"
                                   data-items='{{ json_encode($itemsForModal) }}'
                                   onclick="return tampilkanDetail(this)">Detail</a>
                                @can('view', $sale)
                                <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-sm" style="background-color: #db648a; border-color: #db648a; color: #fff;">Edit</a>
                                @endcan
                                @can('delete', $sale)
                                <form id="deleteForm-{{ $sale->id }}" action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;" onclick="tampilkanHapus('{{ $sale->id }}')">
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
    <div style="background:#fffdf8; border-radius:4px; padding:0; width:300px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.25); font-family:'Courier New', Consolas, monospace; max-height:90vh; overflow-y:auto;">

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

            <hr style="border:none; border-top:1.5px dashed #f0b8cc; margin:10px 0;">

            <!-- Daftar Produk -->
            <div style="font-size:10px; color:#999; letter-spacing:1px; margin-bottom:4px;">PRODUK</div>
            <table style="width:100%; font-size:12px; border-collapse:collapse;">
                <tbody id="dItemsList"></tbody>
            </table>

            <hr style="border:none; border-top:1.5px dashed #f0b8cc; margin:10px 0;">

            <!-- Box QRIS -->
            <div id="dQrisBox" style="display:none; text-align:center; margin-top:4px;">
                <img id="dQrisImg" src="" alt="QRIS" style="width:120px; height:120px; border:1px solid #f0b8cc; padding:6px; border-radius:4px;">
                <div style="font-size:10px; color:#999; letter-spacing:1px; margin-top:4px;">SCAN QRIS</div>
            </div>

            <!-- Box Cash -->
            <div id="dCashBox" style="display:none; margin-top:4px; background:#fbeef3; border-radius:4px; padding:10px 12px;">
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

    <div id="modalHapus" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:1060;">
        <div style="background:#fffdf8; border-radius:8px; padding:28px 24px; width:320px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.25);">
            <div style="font-size:16px; font-weight:700; color:#2a2a2a; margin-bottom:8px;">Hapus penjualan ini?</div>
            <div style="font-size:13px; color:#888; margin-bottom:22px;">Data penjualan akan dihapus permanen dan tidak bisa dikembalikan.</div>
            <div style="display:flex; gap:10px;">
                <button onclick="tutupHapus()" style="flex:1; background:#fff; border:1px solid #eab8c8; color:#d4537e; padding:9px; border-radius:5px; font-size:13px; font-weight:600; cursor:pointer;">Tidak</button>
                <button onclick="konfirmasiHapus()" style="flex:1; background:#d4537e; border:none; color:#fff; padding:9px; border-radius:5px; font-size:13px; font-weight:600; cursor:pointer;">Ya, Hapus</button>
            </div>
        </div>
    </div>

<script>
    function tampilkanDetail(btn) {
        const d = btn.dataset;

        document.getElementById('dId').innerText = d.id;
        document.getElementById('dTanggal').innerText = d.tanggal;
        document.getElementById('dKasir').innerText = d.kasir;
        document.getElementById('dTotal').innerText = d.total;
        document.getElementById('dMetode').innerText = d.metode;

        const statusEl = document.getElementById('dStatus');
        statusEl.innerText = d.status;
        if (d.status === 'COMPLETED') {
            statusEl.style.background = '#e3f9e5';
            statusEl.style.color = '#1f9d55';
            statusEl.style.border = '1px solid #1f9d55';
        } else {
            statusEl.style.background = '#fdf3dc';
            statusEl.style.color = '#a67a12';
            statusEl.style.border = '1px solid #a67a12';
        }

        // Daftar produk
        let items = [];
        try {
            items = JSON.parse(d.items || '[]');
        } catch (e) {
            items = [];
        }

        const listEl = document.getElementById('dItemsList');
        if (items.length > 0) {
            listEl.innerHTML = items.map(item => `
                <tr>
                    <td style="padding:3px 0; color:#2a2a2a;">${item.nama} <span style="color:#999;">x${item.kuantitas}</span></td>
                    <td style="padding:3px 0; text-align:right; font-weight:700; color:#2a2a2a;">Rp${item.subtotal}</td>
                </tr>
            `).join('');
        } else {
            listEl.innerHTML = '<tr><td style="padding:3px 0; color:#999;">Tidak ada produk.</td></tr>';
        }

        const qrisBox = document.getElementById('dQrisBox');
        const cashBox = document.getElementById('dCashBox');
        qrisBox.style.display = 'none';
        cashBox.style.display = 'none';

        if (d.metode === 'QRIS') {
            const isiQr = 'TRX-' + d.id + '|' + d.total;
            document.getElementById('dQrisImg').src =
                'https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=' + encodeURIComponent(isiQr);
            qrisBox.style.display = 'block';
        } else if (d.metode === 'CASH') {
            document.getElementById('dUangDiterima').innerText = 'Rp ' + d.uangDiterima;
            document.getElementById('dKembalian').innerText = 'Rp ' + d.kembalian;
            cashBox.style.display = 'block';
        }

        document.getElementById('modalDetail').style.display = 'flex';
        return false;
    }

    let idHapusSekarang = null;

    function tampilkanHapus(id) {
        idHapusSekarang = id;
        document.getElementById('modalHapus').style.display = 'flex';
    }

    function tutupHapus() {
        idHapusSekarang = null;
        document.getElementById('modalHapus').style.display = 'none';
    }

    function konfirmasiHapus() {
        if (idHapusSekarang) {
            document.getElementById('deleteForm-' + idHapusSekarang).submit();
        }
    }
</script>

@endsection