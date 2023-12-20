<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pet Shop Lontar | {{ $subtitle }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
      <!-- Navbar Search -->


      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        {{--<img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light">Pet Shop Lontar</span>
      </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       {{--}} <div class="image">
          <img src="data:image/jpeg;base64,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" class="img-circle elevation-2" alt="User Image">
        </div>--}}
        <div class="info">
          <a href="#" class="d-block">Hi, {{ Auth::user()->name }} <br> [{{ Auth::user()->role }}]</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if (in_array(Auth::user()->role, ['admin']))
          <li class="nav-item">
            <a href="{{ url('products') }}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          @endif

          @if (in_array(Auth::user()->role, ['admin','kasir','owner']))
          <li class="nav-item">
            <a href="{{ url('transactions') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>
          @endif

          @if (in_array(Auth::user()->role, ['admin']))
          <li class="nav-item">
            <a href="{{ url('users') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          @endif

          @if (in_array(Auth::user()->role, ['admin','kasir','owner']))
          <li class="nav-item">
            <a href="{{ url('log') }}" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Log
              </p>
            </a>
          </li>
          @endif

              <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                  <p class="text-danger">Logout</p>
                </a>
              </li>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy;2023 <a href="LINK">Adnan</a>.</strong> All rights reserved.
  </footer>

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


</body>
</html>
