@extends('layouts.app')

@section('title', 'Edit Jenis')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-5 px-4" style="background-color: #fff5f8; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <h4 class="mb-4 text-center">Edit Jenis</h4>

            <div class="border rounded p-5 bg-white">
                <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
                    @method('PUT')
                    @include('jenis._form')
                </form>
            </div>

        </div>
    </div>
</div>

@endsection