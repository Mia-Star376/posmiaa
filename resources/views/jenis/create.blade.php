@extends('layouts.app')

@section('title', 'Tambah Jenis')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-5 px-4" style="background-color: #fff5f8; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <h4 class="mb-4 text-center">Tambah Jenis</h4>

            <div class="border rounded p-5 bg-white">
                <form action="{{ route('jenis.store') }}" method="POST">
                    @include('jenis._form')
                </form>
            </div>

        </div>
    </div>
</div>

@endsection