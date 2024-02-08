<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Hotel | {{ $subtitle }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="user-role">
              <i class="fas fa-user"></i> {{ Auth::user()->name }}
            </span>
          </a>
          <!-- Dropdown menu -->
          <div class="dropdown-menu" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="{{ url('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')">
        <i class="fas fa-sign-out-alt text-danger"></i>
        <span class="brand-text font-weight-light text-danger">Logout</span>
    </a>
</div>

        </li>
      </ul>
    </nav>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    </ul>
    </nav>
    <style>
      .user-role {
        color: gray;
        font-weight: 600;
      }
    </style>

    <aside class="main-sidebar sidebar-dark-info elevation-4 position-fixed">
      <!-- Brand Logo -->
      <a class="brand-link" href="dashboard">
        <img src="{{ asset('dist/img/logoH.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Hotel PesanAja</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="user-image">

          </div>
          <div class="user-info ml-3 d-flex align-items-center justify-content-center">
            <a href="#" class="brand-text font-weight-light text-center">
              <span class="greeting">Hello,</span>
              <span class="user-role">{{ Auth::user()->role }}</span>
            </a>
          </div>

        </div>
      </div>
      <!-- Sidebar Menu -->

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (in_array(Auth::user()->role, ['admin','kasir','owner']))
          <li class="nav-item @yield('active-menu-dashboard')">
            <a href="{{ url('/') }}" class="nav-link @yield('active-dashboard')">
              <i class="nav-icon fas fa-home"></i>
              <span class="brand-text font-weight-light">
                Dashboard
              </span>
            </a>
          </li>
          @endif
          @if (in_array(Auth::user()->role, ['admin','owner','kasir']))
          <li class="nav-item @yield('active-menu-products')">
            <a href="{{ url('products') }}" class="nav-link @yield('active-products')">
              <i class="nav-icon fas fa-bed "></i>
              <span class="brand-text font-weight-light">
                Kamar
              </span>
            </a>
          </li>
          @endif

          @if (in_array(Auth::user()->role, ['admin','kasir','owner']))
          <li class="nav-item @yield('active-menu-transactions')">
            <a href="{{ url('transactions') }}" class="nav-link @yield('active-transactions')">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <span class="brand-text font-weight-light">
                Transaksi
              </span>
            </a>
          </li>
          @endif

          @if (in_array(Auth::user()->role, ['admin']))
          <li class="nav-item @yield('active-menu-users')">
            <a href="{{ url('users') }}" class="nav-link @yield('active-users')">
              <i class="nav-icon fas fa-users"></i>
              <span class="brand-text font-weight-light">
                Pengguna
              </span>
            </a>
          </li>
          @endif

          @if (in_array(Auth::user()->role, ['owner']))
          <li class="nav-item @yield('active-menu-log')">
            <a href="{{ url('log') }}" class="nav-link @yield('active-log')">
              <i class="nav-icon fas fa-history"></i>
              <span class="brand-text font-weight-light">
                Aktivitas
              </span>
            </a>
          </li>
          @endif
          <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </aside>
  </div>

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper" style="margin">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .content-wrapper {
      flex: 1;
      min-height: 100%;
      /* Set a minimum height for the content-wrapper */
      overflow-y: auto;
      /* Enable vertical scrolling if content overflows */
    }

    .main-footer {
      background-color: #f8f9fa;
      padding: 10px;
      position: sticky;
      bottom: 0;
    }

    .navbar-time {
      display: flex;
      align-items: center;
      color: #808080;
      margin-left: auto;
      padding-right: 20px;
    }
  </style>


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <div class="text-center">
      <strong>
        Egi Subastian
        <a href="http://localhost:8000/">
          <i class="fas fa-hotel fa-lg hotel-icon"></i>
          Hotel PesanAja </a>. Booking Hotel 2024.
      </strong>
    </div>
  </footer>

</body>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>

<!-- Include jQuery (Select2 depends on it) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  integrity="sha512-dmAPYytWQiK6rK3lZ7kDuvQfzxKPpQ/b5QcAg4k8xg+CEN/AIiIQ/30Hp3dSnCgT7R7Q9D4uXgP5r2l5v1aS6g=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />


<script>
  function submitForm() {
    // Add your form submission logic here
    alert("Form submitted!");
  }

  $(document).ready(function () {
    // Add click event to the menu button
    $('#menuButton').click(function () {
      $('body').toggleClass('sidebar-collapse');
    });
  });
</script>


</html>