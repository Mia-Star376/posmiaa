<nav class="navbar navbar-expand-lg" style="background-color: #fff5f8;">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-semibold" href="#" style="color: #d94f83;">Point Of Sale</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active fw-semibold' : '' }}" aria-current="page" href="{{ route('dashboard') }}" style="{{ Request::is('dashboard') ? 'color: #d94f83;' : '' }}">Dashboard</a>
        </li>
        @if(auth()->user()->role_id === 1)
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users') ? 'active fw-semibold' : '' }}" href="{{ route('admin.users') }}" style="{{ Request::is('admin/users') ? 'color: #d94f83;' : '' }}">Users</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link {{ Request::is('jenis') ? 'active fw-semibold' : '' }}" href="{{ route('jenis.index') }}" style="{{ Request::is('jenis') ? 'color: #d94f83;' : '' }}">Jenis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk') ? 'active fw-semibold' : '' }}" href="{{ route('produk.index') }}" style="{{ Request::is('produk') ? 'color: #d94f83;' : '' }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('penjualan') ? 'active fw-semibold' : '' }}" href="{{ route('penjualan.index') }}" style="{{ Request::is('penjualan') ? 'color: #d94f83;' : '' }}">Penjualan</a>
        </li>
      </ul>
      <form action="{{ route('logout') }}" method="POST" class="mb-0">
        @csrf
        <button type="submit" class="btn btn-sm" style="background-color: #ff8fb3; border-color: #ff8fb3; color: #fff;">Logout</button>
      </form>
    </div>
  </div>
</nav>