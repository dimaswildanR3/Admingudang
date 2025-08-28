<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ERP My Logistic</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">

  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  
  
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  <!-- Datatable Jquery -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
<!-- Tambahkan ini di <head> -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>/* === Font Global === */
body, .nav-link, .sidebar-menu, .main-footer, table.dataTable {
    font-family: 'Poppins', sans-serif;
    color: #2c3e50;
    transition: all 0.3s ease;
}

/* === Navbar === */
.navbar {
    background-color: #0A4DA3; /* BIRU BRIMO */
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.navbar .nav-link, .navbar .nav-link i {
    color: #FFFFFF;
    transition: color 0.3s ease, transform 0.3s ease;
}

.navbar .nav-link:hover i,
.navbar .nav-link:hover {
    color: #F37021; /* ORANYE hover */
    transform: scale(1.1);
}

/* Navbar logo */
.sidebar-brand a {
    color:rgb(255, 255, 255);
    font-size: 22px;
    font-weight: 700;
}

/* === Sidebar === */
/* Sidebar default */
.main-sidebar {
    background-color: #0A4DA3; /* BIRU BRIMO */
}

/* Sidebar link */
.sidebar-menu .nav-link {
    color: #FFFFFF; /* teks putih default */
    padding: 10px 15px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

/* Hover link */
.sidebar-menu .nav-link:hover {
    background-color: #F37021 !important; /* ORANYE */
    color: #FFFFFF; /* teks tetap putih */
}

/* Active link */
.sidebar-menu .nav-link.active {
    background-color: #F37021; /* ORANYE saat aktif */
    color: #FFFFFF; /* teks tetap putih */
}

/* Icon di sidebar */
.sidebar-menu .nav-link i {
    margin-right: 10px;
    color: #FFFFFF !important; /* icon putih default */
}

/* Icon saat hover */
.sidebar-menu .nav-link:hover i {
    color: #FFFFFF !important; /* tetap putih saat hover */
}

/* Dropdown submenu */
.sidebar-menu .dropdown-menu li a {
    padding-left: 30px;
    color: #FFFFFF;
    border-radius: 6px;
    display: block;
    transition: all 0.3s ease;
}

.sidebar-menu .dropdown-menu li a:hover {
    background-color: #F37021;
    color: #FFFFFF;
}

/* Sidebar headers */
.menu-header {
    color: #FFFFFF;
    font-weight: 600;
    text-transform: uppercase;
    margin-top: 15px;
    letter-spacing: 0.5px;
}

/* === Footer === */
.main-footer {
    background-color: #0A4DA3; /* BIRU BRIMO */
    color: #FFFFFF;
    padding: 15px 20px;
    font-size: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* === Buttons === */
.btn, .btn i {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

/* === Search Box === */
.search-element input {
    border-radius: 25px;
    padding-left: 20px;
    transition: all 0.3s ease;
}

.search-element input:focus {
    box-shadow: 0 0 8px rgba(243,112,33,0.5); /* ORANYE */
}

/* === Avatar === */
.nav-link img.rounded-circle {
    border: 2px solid #F37021; /* ORANYE */
    transition: transform 0.3s ease;
}

.nav-link img.rounded-circle:hover {
    transform: scale(1.1);
}

/* === Datatable === */
table.dataTable tbody tr:hover {
    background-color: #d1f2eb;
}

table.dataTable thead th {
    background-color: #F37021;
    color: #fff;
}

/* === Cards / Sections === */
.card {
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* === Links Global === */
a {
    transition: all 0.3s ease;
}

a:hover {
    color: #F37021;
    text-decoration: none;
}

</style>

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>

  
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <ul class="navbar-nav navbar-right ml-auto">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="/ubah-password" class="dropdown-item has-icon">
                <i class="fa fa-lock"></i> Ubah Password
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                   Swal.fire({
                     title: 'Konfirmasi Keluar',
                     text: 'Apakah Anda yakin ingin keluar?',
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Ya, Keluar!'
                   }).then((result) => {
                     if (result.isConfirmed) {
                       document.getElementById('logout-form').submit();
                     }
                   });">
                <i class="fas fa-sign-out-alt"></i> Keluar
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
          </li>
          <li class="dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-bell"></i>
        @if($unreadCount > 0)
            <span class="badge badge-danger">{{ $unreadCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="width: 300px;">
        @forelse($notifications as $notification)
            <a href="{{ route('notification.read', $notification->id) }}" 
               class="dropdown-item {{ $notification->is_read ? '' : 'font-weight-bold' }}">
               <strong>{{ $notification->title }}</strong><br>
               {{ \Illuminate\Support\Str::limit($notification->message, 50) }}
               <small class="text-muted float-right">{{ $notification->created_at->diffForHumans() }}</small>
            </a>
            <div class="dropdown-divider"></div>
        @empty
            <span class="dropdown-item text-muted">Tidak ada notifikasi</span>
        @endforelse
    </div>
</li>

        </ul>
      </nav>

      <!-- Sidebar -->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand"><a href="/" style="color:white">ERP My Logistic</a></div>
          <ul class="sidebar-menu"> 
            <li class="sidebar-item">
              <a class="nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}" href="/">
                <i class="fas fa-fire"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
    <a class="nav-link {{ Request::is('pengumuman') ? 'active' : '' }}" href="{{ url('/pengumuman') }}">
        <i class="fas fa-image"></i> <span>Pengumuman</span>
    </a>
</li>

            <li class="menu-header">SURAT</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown {{ Request::is('tulis*') || Request::is('surat*') ? 'active' : '' }}" data-toggle="dropdown">
                <i class="fas fa-envelope"></i><span>Manajemen Surat</span>
              </a>
              <ul class="dropdown-menu">
                <li><a class="nav-link {{ Request::is('tulis') ? 'active' : '' }}" href="{{ route('tulis.index') }}">Tulis Surat</a></li>
                <li><a class="nav-link {{ request()->get('jenis') == 'masuk' ? 'active' : '' }}" href="{{ route('surat.index', ['jenis'=>'masuk']) }}">Surat Masuk</a></li>
                <li><a class="nav-link {{ request()->get('jenis') == 'keluar' ? 'active' : '' }}" href="{{ route('surat.index', ['jenis'=>'keluar']) }}">Surat Keluar</a></li>
              </ul>
            </li>

            <li class="menu-header">DATA MASTER</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown {{ Request::is('barang*') || Request::is('jenis-barang*') || Request::is('satuan-barang*') ? 'active' : '' }}" data-toggle="dropdown">
                <i class="fas fa-cubes"></i><span>Data Barang</span>
              </a>
              <ul class="dropdown-menu">
                <li><a class="nav-link {{ Request::is('barang') ? 'active' : '' }}" href="/barang">Nama Barang</a></li>
                <li><a class="nav-link {{ Request::is('jenis-barang') ? 'active' : '' }}" href="/jenis-barang">Jenis</a></li>
                <li><a class="nav-link {{ Request::is('satuan-barang') ? 'active' : '' }}" href="/satuan-barang">Satuan</a></li>
              </ul>
            </li>
            <li><a class="nav-link {{ Request::is('perusahaan') ? 'active' : '' }}" href="/perusahaan"><i class="fa fa-building"></i><span>Cabang</span></a></li>

            <li class="menu-header">LOGISTIK PUSAT</li>
            <li><a class="nav-link {{ Request::is('laporan-stok') ? 'active' : '' }}" href="laporan-stok"><i class="fa fa-file"></i><span>Stok</span></a></li>
            <li><a class="nav-link {{ Request::is('barang-masuk') ? 'active' : '' }}" href="barang-masuk"><i class="fa fa-arrow-right"></i><span>Barang Masuk</span></a></li>
            <li><a class="nav-link {{ Request::is('barang-keluar') ? 'active' : '' }}" href="barang-keluar"><i class="fa fa-arrow-left"></i><span>Barang Keluar</span></a></li>

            <li class="menu-header">LOGISTIK CABANG</li>
            <li><a class="nav-link {{ Request::is('stok-cabang') ? 'active' : '' }}" href="stok-cabang"><i class="fas fa-warehouse"></i><span>Stok Cabang</span></a></li>

            <li class="menu-header">MANAJEMEN USER</li>
            <li><a class="nav-link {{ Request::is('data-pengguna') ? 'active' : '' }}" href="data-pengguna"><i class="fa fa-users"></i><span>Data Pengguna</span></a></li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('content')
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">ERP My Logistic &copy; {{ date('Y') }}</div>
        <div class="footer-right"></div>
      </footer>
    </div>
  </div>

 
  
  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  
  <!-- Select2 Jquery -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <!-- Datatables Jquery -->
  <script type="text/javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <!-- Sweet Alert -->
  @include('sweetalert::alert')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Day Js Format -->
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>

  
  @stack('scripts')

  
  <script>
    $(document).ready(function() {
      var currentPath = window.location.pathname;
  
      $('.nav-link a[href="' + currentPath + '"]').addClass('active');
    });
  </script>
  
</body>
</html>
