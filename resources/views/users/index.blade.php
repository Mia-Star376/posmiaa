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
                                    <button type="button" class="btn btn-sm" style="background-color: #d94f83; border-color: #d94f83; color: #fff;" onclick="return tampilkanHapusUser(event)">
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

    {{-- ================== MODAL KONFIRMASI HAPUS USER ================== --}}
    <div id="modalHapusUser" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:1060;">
        <div style="background:#fffdf8; border-radius:12px; padding:0; width:320px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.25); text-align:center;">

            <div style="padding:28px 24px 8px;">
                <div style="font-size:16px; font-weight:700; color:#2a2a2a; margin-bottom:6px;">Hapus user ini?</div>
                <div style="font-size:13px; color:#999;">Data user akan dihapus permanen dan tidak bisa dikembalikan.</div>
            </div>

            <div style="padding:20px 24px 24px; display:flex; gap:10px;">
                <button type="button" onclick="tutupHapusUser()"
                    style="flex:1; background:#fff; border:1px solid #f0b8cc; color:#993556; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Tidak
                </button>
                <button type="button" onclick="lanjutkanHapusUser()"
                    style="flex:1; background:#d4537e; border:none; color:#fff; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Ya, Hapus
                </button>
            </div>

        </div>
    </div>

    <script>
        let formHapusRef = null;

        function tampilkanHapusUser(e) {
            e.preventDefault();
            formHapusRef = e.target.closest('form');
            document.getElementById('modalHapusUser').style.display = 'flex';
            return false;
        }

        function tutupHapusUser() {
            document.getElementById('modalHapusUser').style.display = 'none';
            formHapusRef = null;
        }

        function lanjutkanHapusUser() {
            document.getElementById('modalHapusUser').style.display = 'none';
            if (formHapusRef) {
                formHapusRef.submit();
            }
        }
    </script>

@endsection