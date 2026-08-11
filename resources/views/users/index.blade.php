@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid py-4 px-4">

        <h4 class="mb-5 text-center">Users</h4>

        <div class="border rounded p-4 bg-white">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;">Create</a>

                <form action="{{ route('admin.users') }}" method="GET" class="d-flex" style="max-width: 350px; width: 100%;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control form-control-sm"
                        placeholder="Search username or email">
                    <button class="btn btn-outline-secondary btn-sm ms-2" type="submit">
                        Search
                    </button>
                </form>
            </div>

            <div class="rounded-3 overflow-hidden border">
                <table class="table table-sm table-bordered mb-0">
                    <thead>
                        <tr class="text-muted text-center">
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;">
                                    Edit Akun
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm" style="background-color: #d94f83; border-color: #d94f83; color: #fff;" onclick="return confirm('Yakin hapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-muted text-center small">
                                Belum ada data user.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>

        </div>

    </div>

@endsection