@extends('layouts.app')

@section('title', 'About')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid py-4 px-4">

        <h4 class="mb-5 text-center">Tentang Kami</h4>

        <div class="border rounded p-4 bg-white">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <p>Halo, Sahabat Gaya! <br><br>

                    Selamat datang di Ruang Gaya, tempat di mana kreativitas dan gaya berpadu menjadi satu untuk menghadirkan penampilan terbaik versi dirimu. Kami percaya bahwa fashion bukan sekadar soal mengikuti tren, tetapi juga cara untuk mengekspresikan diri dan menunjukkan karakter yang unik dari setiap individu.

                    Di Ruang Gaya, kami menghadirkan beragam koleksi produk fashion pilihan mulai dari pakaian hingga sepatu, dengan desain yang unik, menarik, dan selalu mengikuti perkembangan gaya masa kini. Setiap produk yang kami tawarkan dipilih dengan cermat agar dapat memenuhi kebutuhan gaya berbusana pelanggan, baik untuk tampilan kasual sehari-hari maupun acara-acara spesial.

                    Kami memahami bahwa kepuasan pelanggan adalah kunci utama dalam membangun kepercayaan. Oleh karena itu, kami senantiasa berkomitmen untuk memberikan pelayanan terbaik, mulai dari kualitas produk, kemudahan berbelanja, hingga pengalaman yang menyenangkan bagi setiap pelanggan yang berkunjung ke toko kami. <br><br>

                    Ruang Gaya berlokasi di Jl. K.H Tubagus Abdullah, Tasikmalaya, dan siap menyambut kamu yang ingin tampil percaya diri dengan gaya yang autentik. Kami akan terus berinovasi dan menghadirkan koleksi-koleksi terbaru agar kamu selalu punya pilihan gaya yang segar dan menarik.

                    Terima kasih telah meluangkan waktu untuk mengunjungi Ruang Gaya. Kami tunggu kehadiranmu untuk menemukan gaya terbaikmu bersama kami!</p>

                    <div class=" mb-4">
            <img src="{{ asset('images/logo.svg') }}" alt="Ruang Gaya" style="max-width: 280px; width: 100%; height: auto;">
        </div>
            </div>

        </div>
    </div>

@endsection