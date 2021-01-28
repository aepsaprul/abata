@guest

@yield('content')

@else

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Abata</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="margin-left: .8rem;">
      <span class="brand-text font-weight-light"><img src="{{ asset('assets/dist/img/logo-text.png') }}" alt=""></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('../storage/app/public/' . Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px;">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if (Auth::user()->roles == "administrator")
          
          <li class="nav-header">Master</li>
          <li class="nav-item">
            <a href="{{ url('/cabang') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Cabang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/customer') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Customer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/jabatan') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Jabatan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/karyawan') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Karyawan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/menu') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/user') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                User
              </p>
            </a>
          </li>

          <li class="nav-header">Antrian</li>
          <li class="nav-item">
            <a href="{{ url('/antrian/customer') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Customer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/antrian/cs') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                CS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/antrian/desainer') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Desainer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/antrian/display') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Display
              </p>
            </a>
          </li>
          
          @else

          <li class="nav-item">
            <a href="{{ url('/cabang') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Ambil Antrian
              </p>
            </a>
          </li>

          @endif
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-copy"></i>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <p>
                Logout
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  {{-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>

@yield('script')

</body>
</html>

@endguest

