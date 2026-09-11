<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 border-bottom border-light">
  <div class="container-fluid">
    <!-- Brand/Logo dengan font lebih tegas dan aksen warna -->
    <a class="navbar-brand fw-bold text-primary fs-4" href="#">
      <i class="bi bi-box-seam me-1"></i>POS
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-lg-2">
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 fw-semibold {{ Request::is('dashboard') ? 'active bg-primary-subtle text-primary' : 'text-secondary' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 fw-semibold {{ Request::is('admin.users') ? 'active bg-primary-subtle text-primary' : 'text-secondary' }}" href="{{ route('admin.users') }}">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 fw-semibold {{ Request::is('jenis*') ? 'active bg-primary-subtle text-primary' : 'text-secondary' }}" href="{{ route('jenis.index') }}">Jenis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 fw-semibold {{ Request::is('produk') ? 'active bg-primary-subtle text-primary' : 'text-secondary' }}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 fw-semibold {{ Request::is('penjualan') ? 'active bg-primary-subtle text-primary' : 'text-secondary' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      </ul>

      <!-- Tombol Logout yang rapi di sebelah kanan (Menggantikan position-absolute agar tetap responsif) -->
      <form class="d-flex ms-auto" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-danger fw-semibold px-4 rounded-pill">
          Logout
        </button>
      </form>
    </div>
  </div>
</nav>
