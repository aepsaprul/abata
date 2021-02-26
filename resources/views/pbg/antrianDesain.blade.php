<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Abata Desainer</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	
	<script>
		// Enable pusher logging - don't include this in production
		Pusher.logToConsole = true;
	
		var pusher = new Pusher('d461d5db057e89f9286f', {
			cluster: 'ap2'
		});
	
		var channel = pusher.subscribe('customer-desain');
		channel.bind('customer-desain-event', function(data) {
			if (data.customer_filter_id == 1) {
				var title_filter = "File Siap";
			} else {
				var title_filter = "Desain / Edit";
			}
			var queryNomorAntrian = "" +
				"<div class=\"col-md-2\">" +
					"<div class=\"nomor\">" +
						"<p class=\"nomor-title\">Antrian</p>" +
						"<p class=\"nomor-antrian\">" + data.nomor_antrian + "</p>" +
						"<p class=\"nomor-nama\">" + data.nama + "</p>" +
						"<p class=\"nomor-filter\">" + title_filter + "</p>" +
						"<a href=\"desain/" + data.nomor_antrian + "/panggil\" class=\"btn btn-primary btn-block\">Panggil</a>" +
					"</div>" +
				"</div>";
		
			$('.data-nomor').append(queryNomorAntrian);
		});

		var desain_display = pusher.subscribe('desain-display');
		desain_display.bind('desain-display-event', function(data) {
			location.reload();
		});
		var desain_mulai_display = pusher.subscribe('desain-mulai-display');
		desain_mulai_display.bind('desain-mulai-display-event', function(data) {
			location.reload();
		});
		var desain_selesai_display = pusher.subscribe('desain-selesai-display');
		desain_selesai_display.bind('desain-selesai-display-event', function(data) {
			location.reload();
		});	
	</script>
	
	<style>
		body {
			font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
		}
		h3 {
			text-align: center;
			text-transform: uppercase;
		}
		.layer-1 {
			margin-bottom: 30px;
		}
	
		.desain {
			width: 100%;
			height: 100px;
			background-color: #2d74b9;
		}
	
		.desain-title {
			font-size: 1.5em;
			font-family: sans-serif;
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
	
		.antrian {
			text-align: center;
		}
	
		.antrian-title {
			font-size: 1em;
			font-weight: bold;
			text-align: center;
			text-transform: uppercase;
		}
	
		.antrian-nomor {
			font-size: 8em;
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
			height: 50px;
		}
		.data-nomor .nomor-desain {
			text-align: center;
			color: crimson;
		}
	</style>
</head>
<body class="hold-transition">	
	<section class="content">
		<div class="container-fluid">
			<h3>HALAMAN DESAINER {{ $karyawan->nama_lengkap }}</h3>
			<p style="text-align: center;">
				{{-- {{dd($karyawan)}} --}}
				@if ($karyawan->pbgDesain->status == "off")
					<a href="{{ url('pbg/antrian/desain/' . $karyawan->pbgDesain->id . '/on') }}" class="btn btn-danger">Komputer OFF</a>
				@else
					<a href="{{ url('pbg/antrian/desain/' . $karyawan->pbgDesain->id . '/off') }}" class="btn btn-success">Komputer ON</a>
				@endif
			</p>
			<hr>
			<div class="row">
				<div class="col-12">
						<div class="layer-1">
							<div class="row data-nomor">
								
							</div>
						</div>
						<!-- /.card-body -->
					<!-- /.card -->
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
				url: '{{ URL::route('pbg.antrian.desain.nomor') }}',
				type: 'GET',
				data: {
					_token: CSRF_TOKEN
				},
				success: function(response) {
					console.log(response.data);
					$.each(response.data, function(i, value) {
						
						if (value.customer_filter_id == 1) {
							var title_filter = "Siap Cetak";
						} else if (value.customer_filter_id == 4) {
							var title_filter = "Desain";
						} else if (value.customer_filter_id == 5) {
							var title_filter = "Edit";
						} else {
							var title_filter = "<a href=\"desain/" + value.nomor_antrian + "/jenis/desain\">Desain</a> / <a href=\"desain/" + value.nomor_antrian + "/jenis/edit\">Edit</a>";
						}

						var queryNomorAntrian = "" +
							"<div class=\"col-md-2\" style=\"margin-top: 20px;\">" +
								"<div class=\"nomor\">" +
									"<p class=\"nomor-title\">Antrian</p>" +
									"<p class=\"nomor-antrian\">D " + value.nomor_antrian + "</p>" +
									"<p class=\"nomor-nama\">" + value.nama_customer + "</p>" +
									"<p class=\"nomor-filter\">" + title_filter + "</p>";
									if (value.status == 0) {
										queryNomorAntrian += "<a href=\"desain/" + value.nomor_antrian + "/panggil\" class=\"btn btn-primary btn-block\">Panggil</a>";
									}
									if (value.status == 1) {
										if (value.customer_filter_id == 2) {
											// kosong
										} else {
											queryNomorAntrian += "" +
											"<p class=\"nomor-desain\">" + value.master_karyawan.nama_panggilan + "</p>" +
											"<a href=\"desain/" + value.nomor_antrian + "/mulai\" class=\"btn btn-info btn-block\">Mulai</a>";
										}
									}
									if (value.status == 2) {
										queryNomorAntrian += "" +
										"<p class=\"nomor-desain\">" + value.master_karyawan.nama_panggilan + "</p>" +
										"<a href=\"desain/" + value.nomor_antrian + "/selesai\" class=\"btn btn-success btn-block\">Selesai</a>";
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
