<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Abata Form Customer</title>
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
						<input type="text" class="form-control" id="customer_filter_id" value="{{ $customer_filter_id }}" disabled>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nomor_antrian" value="@if (is_null($nomors)){{ 0 + 1 }}@else{{ $nomors->nomor_antrian + 1 }}@endif" disabled>
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
		<p style="text-align: center;" class="nomor">C
			@if (is_null($nomors))
				{{ 0 + 1 }}
			@else
				{{ $nomors->nomor_antrian + 1 }}
			@endif
		</p>
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
		var btnVal = $('#customer_filter_id').val();

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

			var nomor_antrian = $('#nomor_antrian').val();
			var customer_filter_id = btnVal;
			var nama = $('#nama').val();
			var telepon = $('#telepon').val();

			$.ajax({
				url: '{{ URL::route('antrian.customer.store') }}',
				type: 'POST',
				data: {
					_token: CSRF_TOKEN,
					customer_filter_id: customer_filter_id,
					nomor_antrian: nomor_antrian,
					nama: nama,
					telepon: telepon
				},
				success: function(response) {
					var url = "http://localhost/github/abata/public/antrian/customer";    
					$(location).attr('href',url);
				}
			});
		});

		$('.form-customer').on('submit', function(e) {
			var nomor_antrian = $('#nomor_antrian').val();
			var customer_filter_id = btnVal;
			var nama = $('#nama').val();
			var telepon = $('#telepon').val();

			$.ajax({
				url: '{{ URL::route('antrian.customer.sender') }}',
				type: 'POST',
				data: {
					_token: CSRF_TOKEN,
					nomor_antrian: nomor_antrian,
					customer_filter_id: customer_filter_id,
					nama: nama,
					telepon: telepon
				}
			});
		});
	});
</script>

</body>
</html>
