@extends('layouts.app')

@section('title', 'Data Jenis')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-5 px-4" style="background-color: #fff5f8; min-height: 100vh;">

    <h2 class="text-center fw-bold mb-4">Jenis</h2>

    @if(session('success'))
        <div class="alert" style="background-color: #ffe3ee; border-color: #ff8fb3; color: #d63384;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded p-4 shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            @if(auth()->user()->role_id === 1)
                <a href="{{ route('jenis.create') }}" class="btn btn-pink">Create</a>
            @else
                <span></span>
            @endif

            <form action="{{ route('jenis.index') }}" method="GET" class="d-flex" style="max-width: 350px; width: 100%;">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control form-control-sm"
                    placeholder="Search jenis...">
                <button class="btn btn-outline-secondary btn-sm ms-2" type="submit">
                    Search
                </button>
            </form>
        </div>

        <table class="table table-bordered align-middle">
            <thead>
                <tr class="fw-bold">
                    <th class="text-center" style="width: 60px;">No</th>
                    <th class="text-center">Nama Jenis</th>
                    <th class="text-center" style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenis as $j)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $j->nama_jenis }}</td>
                        <td class="text-center">
                            @if(auth()->user()->role_id === 1)
                                <a href="{{ route('jenis.edit', $j->id) }}" class="btn btn-pink btn-sm">Edit</a>
                                <form action="{{ route('jenis.destroy', $j->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus jenis ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-pink-dark btn-sm">Hapus</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada data jenis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $jenis->links() }}
        </div>

    </div>
</div>

<style>
    .btn-pink {
        background-color: #ff8fb3;
        border-color: #ff8fb3;
        color: #fff;
    }
    .btn-pink:hover {
        background-color: #ff6fa0;
        border-color: #ff6fa0;
        color: #fff;
    }
    .btn-pink-dark {
        background-color: #d63384;
        border-color: #d63384;
        color: #fff;
    }
    .btn-pink-dark:hover {
        background-color: #b02a6b;
        border-color: #b02a6b;
        color: #fff;
    }
</style>

@endsection