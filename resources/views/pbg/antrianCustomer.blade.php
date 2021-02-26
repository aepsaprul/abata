<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Abata Customer</title>
  <!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{ asset('assets/dist/img/logo-bg-blue.png') }}" alt="">
  </div>
	<div class="social-auth-links text-center mb-3">
		<a href="{{ url('pbg/antrian/customer/1/form') }}" class="btn-siap btn btn-block btn-primary pt-3 pb-3 pr-5 pl-5" style="font-size: 2em; font-weight: bold;">
			SIAP CETAK
		</a>
		<a href="{{ url('pbg/antrian/customer/2/form') }}" class="btn-desain btn btn-block btn-primary pt-3 pb-3 pr-5 pl-5" style="font-size: 2em; font-weight: bold;">
			DESAIN / EDIT
		</a>
		<a href="{{ url('pbg/antrian/customer/3/form') }}" class="btn-konsultasi btn btn-block btn-primary pt-3 pb-3 pr-5 pl-5" style="font-size: 2em; font-weight: bold;">
			KONSULTASI
		</a>
	</div>
</div>

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
