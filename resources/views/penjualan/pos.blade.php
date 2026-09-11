@extends('layouts.app')

@section('title', 'POS')

@section('content')

@include('layouts.navbar')

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

                    <form id="formCheckout" method="POST"
                          action="{{ route('penjualan.update', $sale->id) }}"
                          onsubmit="return sebelumCheckout(event)" class="mb-2">
                        @csrf
                        @method('PUT')

                        <select name="payment_method" id="paymentMethod" class="form-select mb-2" onchange="toggleMetode()">
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>

                        {{-- Box Cash --}}
                        <div id="cashBox" style="display:none; background:#fff; border:1px solid #ffc2d6; border-radius:8px; padding:14px; margin-bottom:12px;">
                            <label style="font-size:13px; color:#666; display:block; margin-bottom:6px;">Uang Diterima</label>
                            <input type="number" name="uang_diterima" id="uangDiterima" oninput="hitungKembalian()" placeholder="0"
                                   class="form-control mb-2">

                            <div class="d-flex justify-content-between" style="font-size:14px; color:#666;">
                                <span>Total Belanja</span>
                                <span>Rp {{ number_format($sale->total_pembayaran) }}</span>
                            </div>
                            <div class="d-flex justify-content-between" style="font-size:16px; font-weight:700; color:#d4537e; margin-top:6px;">
                                <span>Kembalian</span>
                                <span id="kembalianLabel">Rp 0</span>
                            </div>
                            <div id="kurangWarning" style="display:none; color:#a12f2f; font-size:12px; margin-top:6px;">Uang belum cukup</div>
                        </div>

                        {{-- Box QRIS --}}
                        <div id="qrisBox" style="display:none; text-align:center; background:#fff; border:1px solid #ffc2d6; border-radius:8px; padding:16px; margin-bottom:12px;">
                            <img id="qrisImg" src="" alt="QRIS" style="width:150px; height:150px;">
                            <div style="font-size:12px; color:#999; margin-top:6px; letter-spacing:1px;">SCAN UNTUK BAYAR</div>
                            <div style="font-size:16px; font-weight:700; color:#d4537e; margin-top:4px;">
                                Rp {{ number_format($sale->total_pembayaran) }}
                            </div>
                        </div>

                        <button style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;" class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            Checkout
                        </button>
                    </form>

                    @can('delete', $sale)
                    <form id="formBatal" action="{{ route('penjualan.destroy', $sale->id) }}"
                          method="POST"
                          onsubmit="return tampilkanKonfirmasiBatal(event)">
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

    {{-- ================== MODAL ALERT (pengganti alert()) ================== --}}
    <div id="modalAlert" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:1070;">
        <div style="background:#fffdf8; border-radius:12px; padding:0; width:300px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.25); text-align:center;">
            <div style="padding:26px 22px 6px;">
                <div id="alertMessage" style="font-size:14px; color:#2a2a2a; font-weight:600;"></div>
            </div>
            <div style="padding:18px 22px 22px;">
                <button type="button" onclick="tutupAlert()"
                    style="width:100%; background:#d4537e; border:none; color:#fff; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

    {{-- ================== MODAL KONFIRMASI CHECKOUT ================== --}}
    <div id="modalKonfirmasi" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:1060;">
        <div style="background:#fffdf8; border-radius:12px; padding:0; width:320px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.25); text-align:center;">

            <div style="padding:28px 24px 8px;">
                <div style="font-size:16px; font-weight:700; color:#2a2a2a; margin-bottom:6px;">Yakin ingin checkout?</div>
                <div style="font-size:13px; color:#999;">Transaksi akan diselesaikan dan tidak bisa diubah lagi.</div>
            </div>

            <div style="padding:20px 24px 24px; display:flex; gap:10px;">
                <button type="button" onclick="batalKonfirmasi()"
                    style="flex:1; background:#fff; border:1px solid #f0b8cc; color:#993556; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Batal
                </button>
                <button type="button" onclick="lanjutkanCheckout()"
                    style="flex:1; background:#d4537e; border:none; color:#fff; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Ya, Checkout
                </button>
            </div>

        </div>
    </div>

    {{-- ================== MODAL KONFIRMASI BATAL TRANSAKSI ================== --}}
    <div id="modalKonfirmasiBatal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:1060;">
        <div style="background:#fffdf8; border-radius:12px; padding:0; width:320px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.25); text-align:center;">

            <div style="padding:28px 24px 8px;">
                <div style="font-size:16px; font-weight:700; color:#2a2a2a; margin-bottom:6px;">Batalkan transaksi ini?</div>
                <div style="font-size:13px; color:#999;">Semua item di keranjang akan dihapus.</div>
            </div>

            <div style="padding:20px 24px 24px; display:flex; gap:10px;">
                <button type="button" onclick="tutupKonfirmasiBatal()"
                    style="flex:1; background:#fff; border:1px solid #f0b8cc; color:#993556; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Tidak
                </button>
                <button type="button" onclick="lanjutkanBatal()"
    style="flex:1; background:#d4537e; border:none; color:#fff; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
    Ya, Batalkan
</button>
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

<script>
    const totalBelanja = {{ $sale->total_pembayaran }};

    // ============ TOGGLE METODE PEMBAYARAN ============
    function toggleMetode() {
        const metode = document.getElementById('paymentMethod').value;
        document.getElementById('cashBox').style.display = 'none';
        document.getElementById('qrisBox').style.display = 'none';

        if (metode === 'CASH') {
            document.getElementById('uangDiterima').value = '';
            document.getElementById('kembalianLabel').innerText = 'Rp 0';
            document.getElementById('cashBox').style.display = 'block';
        } else if (metode === 'QRIS') {
            document.getElementById('qrisImg').src =
                'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' + encodeURIComponent('TOTAL:' + totalBelanja);
            document.getElementById('qrisBox').style.display = 'block';
        }
    }

    function hitungKembalian() {
        const diterima = parseFloat(document.getElementById('uangDiterima').value) || 0;
        const kembalian = diterima - totalBelanja;
        const label = document.getElementById('kembalianLabel');
        const warning = document.getElementById('kurangWarning');

        if (kembalian < 0) {
            label.innerText = 'Rp 0';
            warning.style.display = 'block';
        } else {
            label.innerText = 'Rp ' + kembalian.toLocaleString('id-ID');
            warning.style.display = 'none';
        }
    }

    // ============ MODAL ALERT (pengganti alert()) ============
    function tampilkanAlert(pesan) {
        document.getElementById('alertMessage').innerText = pesan;
        document.getElementById('modalAlert').style.display = 'flex';
    }

    function tutupAlert() {
        document.getElementById('modalAlert').style.display = 'none';
    }

    // ============ CHECKOUT (pengganti confirm()) ============
    function sebelumCheckout(e) {
        e.preventDefault();

        const metode = document.getElementById('paymentMethod').value;

        if (!metode) {
            tampilkanAlert('Pilih metode pembayaran dulu');
            return false;
        }

        if (metode === 'CASH') {
            const diterima = parseFloat(document.getElementById('uangDiterima').value) || 0;
            if (diterima < totalBelanja) {
                tampilkanAlert('Uang diterima kurang dari total belanja');
                return false;
            }
        }

        document.getElementById('modalKonfirmasi').style.display = 'flex';
        return false;
    }

    function batalKonfirmasi() {
        document.getElementById('modalKonfirmasi').style.display = 'none';
    }

    function lanjutkanCheckout() {
        document.getElementById('modalKonfirmasi').style.display = 'none';
        document.getElementById('formCheckout').submit();
    }

    // ============ BATAL TRANSAKSI (pengganti confirm()) ============
    function tampilkanKonfirmasiBatal(e) {
        e.preventDefault();
        document.getElementById('modalKonfirmasiBatal').style.display = 'flex';
        return false;
    }

    function tutupKonfirmasiBatal() {
        document.getElementById('modalKonfirmasiBatal').style.display = 'none';
    }

    function lanjutkanBatal() {
        document.getElementById('modalKonfirmasiBatal').style.display = 'none';
        document.getElementById('formBatal').submit();
    }
</script>

@endsection