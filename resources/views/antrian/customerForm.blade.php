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

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{ asset('assets/dist/img/logo-bg-blue.png') }}" alt="">
  </div>
	<div class="social-auth-links text-center mb-3">
		<div class="card">
			<form role="form" class="form-customer">
				<div class="card-body">
					<div class="form-group">
						<input type="hidden" class="form-control" id="customer_filter_id" value="{{ $customer_filter_id }}" disabled>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nama" required placeholder="Masukkan nama">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="telepon" required placeholder="Masukkan nomor telepon">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Cetak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="nomor-antrian">
		<p style="text-align: center; text-transform: uppercase;">Nomor Antrian</p>
		<p style="text-align: center;" class="nomor">{{ $nomors->nomor_antrian + 1 }}</p>
	</div>
</div>

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<script>
	$(document).ready(function() {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var btnVal;
		var no = $('.nomor').text();

		$('.nomor-antrian').hide();

		// nomorAntrian();

		function nomorAntrian() {
			$.ajax({
				url: '{{ URL::route('antrian.customer.nomor') }}',
				type: 'GET',
				data: {
					_token: CSRF_TOKEN
				},
				success: function(response) {
					var jumlahQuery = response.nomors.length;
					$('.nomor-antrian .nomor').append(jumlahQuery + 1);
				}
			});
		}

		$('.form-customer').on('submit', function(e) {
			e.preventDefault();

			$('.form-customer').hide();
			$('.social-auth-links').hide();
			$('.login-logo').hide();
			$('.nomor-antrian').show();

			// window.print();

			var btnFile = btnVal;
			var nama = $('#nama').val();
			var telepon = $('#telepon').val();

			$.ajax({
				url: '{{ URL::route('antrian.customer.store') }}',
				type: 'POST',
				data: {
					_token: CSRF_TOKEN,
					btnfile: btnFile,
					nama: nama,
					telepon: telepon
				},
				success: function(response) {
					location.reload();
				}
			});
		});

		$('.form-modal').on('submit', function(e) {
			var btnFile = btnVal;
			var nama = $('#nama').val();
			var telepon = $('#telepon').val();

			$.ajax({
				url: '{{ URL::route('antrian.customer.sender') }}',
				type: 'POST',
				data: {
					_token: CSRF_TOKEN,
					nomor: no,
					customer_filter_id: btnFile,
					nama: nama,
					telepon: telepon
				},
				success: function(response) {
					location.load();
				}
			});
		});
	});
</script>

</body>
</html>
