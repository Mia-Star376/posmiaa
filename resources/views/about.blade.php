@extends('layouts.app')

@section('title', 'About')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid py-4 px-4 d-flex align-items-center justify-content-center" style="min-height: 75vh;">

        <div class="row justify-content-center w-100">
            <div class="col-lg-8">

                <h4 class="mb-4 text-center">Tentang</h4>

                <div class="border rounded p-4 bg-white mb-4">
                    <p class="mb-0 text-center">
                        Halo, perkenalkan saya Mia Sumiyati, siswi di SMKN 4 Tasikmalaya. Saya membuat aplikasi Ruang Gaya - Point of Sale ini sebagai proyek tugas akhir. Ruang Gaya - POS adalah aplikasi kasir digital sekaligus sistem pendataan produk yang membantu proses pencatatan transaksi penjualan dan pengelolaan data produk secara lebih cepat, rapi, dan terkomputerisasi, dibangun menggunakan Laravel sebagai framework PHP, MySQL sebagai basis data, Bootstrap untuk tampilan antarmuka, serta JavaScript untuk interaksi dinamis seperti modal konfirmasi dan kalkulasi kembalian otomatis. Aplikasi ini memiliki dua peran pengguna: Admin, yang memiliki akses penuh untuk mengelola data pengguna (users), data jenis produk (kategori), serta menambah/mengubah/menghapus data produk, dan memantau ringkasan penjualan dan laporan transaksi harian melalui dashboard; dan Kasir, yang bertugas memproses transaksi penjualan sehari-hari mulai dari memilih produk, mengatur keranjang belanja, hingga melakukan checkout dengan metode pembayaran Cash atau QRIS, tanpa memiliki akses untuk mengubah data pengguna, jenis produk, maupun data produk. Aplikasi ini dibuat dengan tujuan menerapkan ilmu pengembangan web, khususnya Laravel, ke dalam sebuah studi kasus nyata, yaitu sistem Point of Sale untuk usaha kecil/menengah, sekaligus melatih kemampuan merancang alur transaksi yang efisien dan ramah pengguna. Semoga aplikasi Ruang Gaya - Point of Sale ini dapat terus dikembangkan lebih lanjut, baik dari sisi fitur seperti laporan keuangan, integrasi pembayaran QRIS yang sesungguhnya, dan cetak struk otomatis, maupun dari sisi tampilan, sehingga bisa benar-benar bermanfaat bagi pengguna yang menjalankan usahanya.
                    </p>
                </div>

            </div>
        </div>

    </div>

@endsection