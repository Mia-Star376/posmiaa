@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')


<form action="{{ route('produk.update', $produk) }}"
      method="POST"
      enctype="multipart/form-data">
      @method('PUT')
    @include('Produk._form')
</form>
@endsection