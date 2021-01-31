<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Abata</title>
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
			// alert(JSON.stringify(data));
			var queryNomorAntrian = "" +
				"<div class=\"col-md-1\">" +
					"<div class=\"nomor\">" +
						"<p class=\"nomor-title\">Antrian</p>" +
						"<p class=\"nomor-antrian\">" + data.nomor_antrian + "</p>" +
						"<p class=\"nomor-nama\">" + data.nama + "</p>" +
						"<p class=\"nomor-filter\">" + data.customer_filter_id + "</p>" +
						"<button class=\"btn btn-primary btn-block\">Panggil</button>" +
					"</div>" +
				"</div>";
		
			$('.data-nomor').append(queryNomorAntrian);
		});
	</script>
	
	<style>
		.layer-1 {
			margin-top: 30px;
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
			font-family: sans-serif;
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
			font-family: sans-serif;
			font-weight: bold;
			text-align: center;
			text-transform: uppercase;
			background-color: #fbdd23;
		}

		.nomor .nomor-antrian {
			font-size: 2em;
			font-family: sans-serif;
			font-weight: bold;
			text-align: center;
		}

		.nomor .nomor-nama, .nomor .nomor-filter {
			font-size: 0.8em;
			font-family: sans-serif;
			font-weight: bold;
			text-align: center;
			text-transform: uppercase;
		}
	
		.antrian {
			text-align: center;
		}
	
		.antrian-title {
			font-size: 1em;
			font-family: sans-serif;
			font-weight: bold;
			text-align: center;
			text-transform: uppercase;
		}
	
		.antrian-nomor {
			font-size: 8em;
			font-family: sans-serif;
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
									<div class="row">
										<div class="col">
											<div class="desain">
												<p class="desain-title">Desain 1</p>
												<p class="desain-nomor">4</p>
											</div>
										</div>
										<div class="col">
											<div class="desain">
												<p class="desain-title">Desain 1</p>
												<p class="desain-nomor">4</p>
											</div>
										</div>
										<div class="col">
											<div class="desain">
												<p class="desain-title">Desain 1</p>
												<p class="desain-nomor">4</p>
											</div>
										</div>
										<div class="col">
											<div class="desain">
												<p class="desain-title">Desain 1</p>
												<p class="desain-nomor">4</p>
											</div>
										</div>
										<div class="col">
											<div class="desain">
												<p class="desain-title">Desain 1</p>
												<p class="desain-nomor">4</p>
											</div>
										</div>
										<div class="col">
											<div class="desain">
												<p class="desain-title">Desain 1</p>
												<p class="desain-nomor">4</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr>
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
				url: '{{ URL::route('antrian.desainer.nomor') }}',
				type: 'GET',
				data: {
					_token: CSRF_TOKEN
				},
				success: function(response) {
					$.each(response.data, function(i, value) {
						var queryNomorAntrian = "" +
							"<div class=\"col-md-1\">" +
								"<div class=\"nomor\">" +
									"<p class=\"nomor-title\">Antrian</p>" +
									"<p class=\"nomor-antrian\">" + value.nomor_antrian + "</p>" +
									"<p class=\"nomor-nama\">" + value.nama + "</p>" +
									"<p class=\"nomor-filter\">" + value.customer_filter_id + "</p>" +
									"<button class=\"btn btn-primary btn-block\">Panggil</button>" +
								"</div>" +
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
