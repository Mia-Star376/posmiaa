@extends('layouts.app')

@section('title', 'Tambah Jenis')

@section('content')

@include('layouts.navbar')

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

@endsection