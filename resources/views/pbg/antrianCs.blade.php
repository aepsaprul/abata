<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Abata CS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
	{{-- pusher --}}
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	
	<script>
		// Enable pusher logging - don't include this in production
		Pusher.logToConsole = true;
	
		var pusher = new Pusher('d461d5db057e89f9286f', {
			cluster: 'ap2'
		});
	
		var channel = pusher.subscribe('customer-cs');
		channel.bind('customer-cs-event', function(data) {
			
			var queryNomorAntrian = "" +
				"<div class=\"col-md-2\">" +
					"<div class=\"nomor\">" +
						"<p class=\"nomor-title\">Antrian</p>" +
						"<p class=\"nomor-antrian\">" + data.nomor_antrian + "</p>" +
						"<p class=\"nomor-nama\">" + data.nama + "</p>" +
						// "<p class=\"nomor-filter\">" + data.customer_filter_id + "</p>";
						"<a href=\"cs/" + data.nomor_antrian + "/panggil\" class=\"btn btn-primary btn-block\">Panggil</a>" +
					"</div>" +
				"</div>";
		
			$('.data-nomor').append(queryNomorAntrian);

		});
	</script>
	
	<style>
		body {
			font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
		}

		.btn-reset {
			position: fixed;
			right: 30px;
		}
		
		.layer-1 {
			margin-top: 30px;
			margin-bottom: 30px;
		}

		h3 {
			text-align: center;
		}
	
		.desain {
			width: 100%;
			height: 100px;
			background-color: #2d74b9;
		}
	
		.desain-title {
			font-size: 1.5em;
			font-weight: bold;
			text-align: center;
			text-transform: uppercase;
			background-color: #fbdd23;
		}
	
		.desain-nomor {
			font-size: 2em;
			font-weight: bold;
			text-align: center;
			color: #fff;
		}

		.nomor {
			width: 100%;
			height: 100%;
			background-color: #e9e9e9;
		}

		.nomor .nomor-title {
			font-size: 1em;
			font-weight: bold;
			text-align: center;
			text-transform: uppercase;
			background-color: #fbdd23;
		}

		.nomor .nomor-antrian {
			font-size: 2em;
			font-weight: bold;
			text-align: center;
		}

		.nomor .nomor-nama, .nomor .nomor-filter {
			font-size: 0.8em;
			font-weight: bold;
			text-align: center;
			text-transform: uppercase;
		}

		.data-nomor .col-md-1 {
			margin-top: 10px;
		}
		.data-nomor p {
			margin: 0;
			padding: 0;
		}
		.data-nomor .nomor-nama {
			height: 30px;
		}
	</style>
</head>
<body class="hold-transition">	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="layer-1">
						<div class="row">
							<div class="col-md-12">
								<a href="{{ url('pbg/antrian/cs/reset') }}" class="btn btn-danger btn-reset" onclick="return confirm('Yakin akan melakukan reset?')">Reset Nomor Antrian</a>
								<h3>HALAMAN CUSTOMER SERVICE</h3>
								<p style="text-align: center;">
									@if ($karyawan->pbgCs->status == "off")
										<a href="{{ url('pbg/antrian/cs/' . $karyawan->pbgCs->id . '/on') }}" class="btn btn-danger">Komputer OFF</a>
									@else
										<a href="{{ url('pbg/antrian/cs/' . $karyawan->pbgCs->id . '/off') }}" class="btn btn-success">Komputer ON</a>
									@endif
								</p>
							</div>
						</div>
						<hr>
						<div class="row data-nomor">
							
						</div>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<script>
	$(document).ready(function() {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 
		nomorAntrian();

		function nomorAntrian(timestamp) {
			$('.data-nomor').empty();
			$.ajax({
				url: '{{ URL::route('pbg.antrian.cs.nomor') }}',
				type: 'GET',
				data: {
					_token: CSRF_TOKEN
				},
				success: function(response) {
					$.each(response.data, function(i, value) {
						var queryNomorAntrian = "" +
							"<div class=\"col-md-2\">" +
								"<div class=\"nomor\">" +
									"<p class=\"nomor-title\">Antrian</p>" +
									"<p class=\"nomor-antrian\">C " + value.nomor_antrian + "</p>" +
									"<p class=\"nomor-nama\">" + value.nama_customer + "</p>";
									// "<p class=\"nomor-filter\">" + value.customer_filter_id + "</p>";
									if (value.status == 0) {
										queryNomorAntrian += "<a href=\"cs/" + value.nomor_antrian + "/panggil\" class=\"btn btn-primary btn-block\">Panggil</a>";
									}
									if (value.status == 1) {
										queryNomorAntrian += "<a href=\"cs/" + value.nomor_antrian + "/mulai\" class=\"btn btn-info btn-block\">Mulai</a>";
									}
									if (value.status == 2) {
										queryNomorAntrian += "<a href=\"cs/" + value.nomor_antrian + "/selesai\" class=\"btn btn-success btn-block\">Selesai</a>";
									}
									queryNomorAntrian += "</div>";
							"</div>";
					
						$('.data-nomor').append(queryNomorAntrian);
					});
				}
			});
		}

	});
</script>

</body>
</html>
