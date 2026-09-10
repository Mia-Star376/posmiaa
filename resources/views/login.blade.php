@extends('layouts.app')

@section('title', 'Login')

@section('content')




@vite(['resources/css/app.css', 'resources/js/app.js' ])

<style>
    .form-control:focus {
        background-color: rgba(255,255,255,0.2);
        border-color: #ff8fb3;
        box-shadow: 0 0 0 3px rgba(255, 143, 179, 0.35);
        color: #fff;
    }
</style>

<div style="
    background-image: url('{{ asset('images/pinkk.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    width: 100vw;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    ">

<div class="card text-center position-absolute top-50 start-50 translate-middle" style="width: 18rem; background-color: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 24px; overflow: hidden;">
  <h5 class="card-header" style="color: #fff">Ruang Gaya</h5>
  <div class="card-body">

  <form action="{{ route('auth') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label" style="color: #fff;">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
            style="background-color: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.4); border-radius: 12px; color: #fff; padding: 10px 14px;">
        @error('email')
            <div class="badge text-bg-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label" style="color: #fff;">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
            style="background-color: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.4); border-radius: 12px; color: #fff; padding: 10px 14px;">
        @error('password')
            <div class="badge text-bg-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn" style="background-color: rgba(255,255,255,0.25); border: 1px solid rgba(255,255,255,0.5); border-radius: 12px; color: #fff; padding: 8px 24px;">Submit</button>
</form>
  </div>
</div>
</div>


@endsection