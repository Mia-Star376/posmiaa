<div class="container-fluid py-5 px-4">
    <div class="row justify-content-center mt-5 pt-5">
        <div class="col-lg-10">

            <h4 class="mb-4 text-center">{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h4>

            <div class="border rounded p-5 bg-white">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email ?? '') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Role</label>
                    <select name="role_id"
                            class="form-select @error('role_id') is-invalid @enderror">
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-pink" type="submit">Simpan</button>
                    <a href="{{ route('admin.users') }}" class="btn btn-pink-outline">Kembali</a>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .btn-pink {
        background-color: #d63384;
        border-color: #d63384;
        color: #fff;
    }
    .btn-pink:hover {
        background-color: #b02a6b;
        border-color: #b02a6b;
        color: #fff;
    }
    .btn-pink-outline {
        background-color: transparent;
        border: 1px solid #f394c0;
        color: #f394c0;
    }
    .btn-pink-outline:hover {
        background-color: #f394c0;
        color: #fff;
    }
</style>