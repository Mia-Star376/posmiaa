@extends('layouts.app')

@section('title', 'Data Jenis')

@section('content')

@include('layouts.navbar')


    <h2 class="text-center fw-bold mb-4">Jenis</h2>
    

    

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
                                <form action="{{ route('jenis.destroy', $j->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-pink-dark btn-sm" onclick="return tampilkanHapusJenis(event)">Hapus</button>
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

    {{-- ================== MODAL KONFIRMASI HAPUS JENIS ================== --}}
    <div id="modalHapusJenis" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:1060;">
        <div style="background:#fffdf8; border-radius:12px; padding:0; width:320px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.25); text-align:center;">

            <div style="padding:28px 24px 8px;">
                <div style="font-size:16px; font-weight:700; color:#2a2a2a; margin-bottom:6px;">Hapus jenis ini?</div>
                <div style="font-size:13px; color:#999;">Data jenis akan dihapus permanen dan tidak bisa dikembalikan.</div>
            </div>

            <div style="padding:20px 24px 24px; display:flex; gap:10px;">
                <button type="button" onclick="tutupHapusJenis()"
                    style="flex:1; background:#fff; border:1px solid #f0b8cc; color:#993556; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Tidak
                </button>
                <button type="button" onclick="lanjutkanHapusJenis()"
                    style="flex:1; background:#d4537e; border:none; color:#fff; padding:10px; border-radius:8px; font-weight:600; cursor:pointer;">
                    Ya, Hapus
                </button>
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

<script>
    let formHapusJenisRef = null;

    function tampilkanHapusJenis(e) {
        e.preventDefault();
        formHapusJenisRef = e.target.closest('form');
        document.getElementById('modalHapusJenis').style.display = 'flex';
        return false;
    }

    function tutupHapusJenis() {
        document.getElementById('modalHapusJenis').style.display = 'none';
        formHapusJenisRef = null;
    }

    function lanjutkanHapusJenis() {
        document.getElementById('modalHapusJenis').style.display = 'none';
        if (formHapusJenisRef) {
            formHapusJenisRef.submit();
        }
    }
</script>

@endsection