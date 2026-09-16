@extends('layouts.app')

@section('title', 'About')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --brand-pink: #ec4899;
        --brand-pink-soft: #fce7f0;
        --brand-pink-dark: #be185d;
    }

    .rg-hero {
        background: linear-gradient(135deg, var(--brand-pink-soft), #ffffff);
        border-radius: 1.5rem;
        padding: 2.5rem 2rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    .rg-hero h4 {
        color: var(--brand-pink-dark);
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .rg-hero p {
        color: #9d174d;
        opacity: 0.75;
        margin-bottom: 0;
    }

    .rg-feature-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: var(--brand-pink-soft);
        color: var(--brand-pink);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .rg-card {
        border: none;
        border-radius: 1.25rem;
        background: #fff;
        box-shadow: 0 4px 20px rgba(236, 72, 153, 0.08);
        transition: box-shadow 0.2s ease;
    }

    .rg-card:hover {
        box-shadow: 0 8px 28px rgba(236, 72, 153, 0.14);
    }

    .rg-text {
        line-height: 1.85;
        color: #4b5563;
    }

    .rg-info-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--brand-pink-soft);
        color: var(--brand-pink);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>

<div class="container-fluid py-4 px-4">

    {{-- Hero --}}
    <div class="rg-hero">
        <h4 class="mb-2">Tentang Kami</h4>
        <p>Kenali lebih dekat cerita di balik Ruang Gaya</p>
    </div>

    {{-- Feature strip --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="rg-card p-3 d-flex align-items-center gap-3">
                <div class="rg-feature-icon"><i class="bi bi-stars"></i></div>
                <div>
                    <div class="fw-semibold">Desain Unik</div>
                    <div class="small text-secondary">Selalu ikuti tren terkini</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="rg-card p-3 d-flex align-items-center gap-3">
                <div class="rg-feature-icon"><i class="bi bi-shield-check"></i></div>
                <div>
                    <div class="fw-semibold">Kualitas Terjamin</div>
                    <div class="small text-secondary">Produk pilihan terbaik</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="rg-card p-3 d-flex align-items-center gap-3">
                <div class="rg-feature-icon"><i class="bi bi-heart"></i></div>
                <div>
                    <div class="fw-semibold">Pelayanan Ramah</div>
                    <div class="small text-secondary">Pengalaman belanja nyaman</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- Kolom kiri: konten utama --}}
        <div class="col-lg-8">
            <div class="rg-card p-4 p-md-5 h-100">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge rounded-pill" style="background: var(--brand-pink-soft); color: var(--brand-pink-dark);">
                        Halo, Sahabat Gaya!
                    </span>
                </div>

                <p class="rg-text">
                    Selamat datang di Ruang Gaya, tempat di mana kreativitas dan gaya berpadu menjadi satu
                    untuk menghadirkan penampilan terbaik versi dirimu. Kami percaya bahwa fashion bukan
                    sekadar soal mengikuti tren, tetapi juga cara untuk mengekspresikan diri dan menunjukkan
                    karakter yang unik dari setiap individu.
                </p>

                <p class="rg-text">
                    Di Ruang Gaya, kami menghadirkan beragam koleksi produk fashion pilihan mulai dari
                    pakaian hingga sepatu, dengan desain yang unik, menarik, dan selalu mengikuti
                    perkembangan gaya masa kini. Setiap produk yang kami tawarkan dipilih dengan cermat
                    agar dapat memenuhi kebutuhan gaya berbusana pelanggan, baik untuk tampilan kasual
                    sehari-hari maupun acara-acara spesial.
                </p>

                <p class="rg-text">
                    Kami memahami bahwa kepuasan pelanggan adalah kunci utama dalam membangun kepercayaan.
                    Oleh karena itu, kami senantiasa berkomitmen untuk memberikan pelayanan terbaik, mulai
                    dari kualitas produk, kemudahan berbelanja, hingga pengalaman yang menyenangkan bagi
                    setiap pelanggan yang berkunjung ke toko kami.
                </p>

                <hr class="my-4" style="border-color: var(--brand-pink-soft);">

                <p class="rg-text">
                    Ruang Gaya berlokasi di Jl. K.H Tubagus Abdullah, Tasikmalaya, dan siap menyambut kamu
                    yang ingin tampil percaya diri dengan gaya yang autentik. Kami akan terus berinovasi
                    dan menghadirkan koleksi-koleksi terbaru agar kamu selalu punya pilihan gaya yang segar
                    dan menarik.
                </p>

                <p class="rg-text mb-0">
                    Terima kasih telah meluangkan waktu untuk mengunjungi Ruang Gaya. Kami tunggu
                    kehadiranmu untuk menemukan gaya terbaikmu bersama kami!
                </p>

            </div>
        </div>

        {{-- Kolom kanan: logo + info singkat --}}
        <div class="col-lg-4 d-flex flex-column gap-4">

            <div class="rg-card p-4 text-center">
                <img src="{{ asset('images/logo.svg') }}" alt="Ruang Gaya"
                     style="max-width: 130px; width: 100%; height: auto;">
            </div>

            <div class="rg-card p-4 flex-grow-1">
                <h6 class="fw-semibold mb-4">Info Toko</h6>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rg-info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <div class="fw-medium">Lokasi</div>
                        <div class="text-secondary small">Jl. K.H Tubagus Abdullah, Tasikmalaya</div>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rg-info-icon"><i class="bi bi-clock-fill"></i></div>
                    <div>
                        <div class="fw-medium">Jam Operasional</div>
                        <div class="text-secondary small">Setiap hari, 09.00 - 21.00</div>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3">
                    <div class="rg-info-icon"><i class="bi bi-bag-check-fill"></i></div>
                    <div>
                        <div class="fw-medium">Produk</div>
                        <div class="text-secondary small">Pakaian &amp; Sepatu Fashion</div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection