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
		<button class="btn-siap btn btn-block btn-primary pt-3 pb-3 pr-5 pl-5" style="font-size: 2em; font-weight: bold;">
			SIAP CETAK
		</button>
		<button class="btn-desain btn btn-block btn-primary pt-3 pb-3 pr-5 pl-5" style="font-size: 2em; font-weight: bold;">
			DESAIN / EDIT
		</button>
		<button class="btn-konsultasi btn btn-block btn-primary pt-3 pb-3 pr-5 pl-5" style="font-size: 2em; font-weight: bold;">
			KONSULTASI
		</button>
	</div>
	<div class="nomor-antrian">
		<p style="text-align: center; text-transform: uppercase;">Nomor Antrian</p>
		<p style="text-align: center;" class="nomor">{{ $nomors->nomor_antrian + 1 }}</p>
	</div>
</div>

{{-- modal --}}
<div class="modal fade" id="modal-desain">
	<div class="modal-dialog" style="margin-top: 150px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
					<!-- /.card-header -->
					<!-- form start -->
					<form role="form" class="form-modal">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" required placeholder="Masukkan nama">
						</div>
						<div class="form-group">
							<label for="telepon">Nomor HP</label>
							<input type="tel" class="form-control" id="telepon" required placeholder="Masukkan nomor HP">
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-primary btn-block btn-cetak-siap">Cetak</button>
						</div>
					</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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

		$('.btn-siap').on('click', function() {
			$('#modal-desain').modal('show');
			btnVal = 1;
		});

		$('.btn-desain').on('click', function() {
			$('#modal-desain').modal('show');
			btnVal = 2;
		});

		$('.btn-konsultasi').on('click', function() {
			$('#modal-desain').modal('show');
			btnVal = 3;
		});

		$('.form-modal').on('submit', function(e) {
			e.preventDefault();

			$('.modal').hide();
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
