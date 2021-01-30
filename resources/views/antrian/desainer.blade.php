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
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-body antrian">
											<p><button class="btn btn-primary btn-block">Timer</button></p>
										</div>
										<!-- /.card-body -->
									</div>
									<!-- /.card -->
								</div>
								<div class="col-md-4"></div>
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
	});
</script>

</body>
</html>
