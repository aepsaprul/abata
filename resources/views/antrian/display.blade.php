<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Abata Display</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	
	<script>
		// Enable pusher logging - don't include this in production
		Pusher.logToConsole = true;
	
		var pusher = new Pusher('d461d5db057e89f9286f', {
			cluster: 'ap2'
		});
		// customer ke cs display 
		var channel = pusher.subscribe('customer-cs-display');
		channel.bind('customer-cs-display-event', function(data) {

			$('.antrian_total_cs').empty();
			
			var queryNomorAntrian = data.antrian_total;
		
			$('.antrian_total_cs').append(queryNomorAntrian);
			
		});
		// customer ke desain display
		var desain_channel = pusher.subscribe('customer-desain-display');
		desain_channel.bind('customer-desain-display-event', function(data) {

			$('.antrian_total_desain').empty();
			
			var queryNomorAntrian = data.antrian_total;
		
			$('.antrian_total_desain').append(queryNomorAntrian);
			
		});
		// cs ke display 
		var cs_display = pusher.subscribe('cs-display');
		cs_display.bind('cs-display-event', function(data) {

			$('.antrian_cs').empty();
			
			var queryNomorAntrian = data.antrian_nomor;
		
			$('.antrian_cs').append(queryNomorAntrian);
			
		});
		// update ketika cs klik mulai 
		var cs_mulai_display = pusher.subscribe('cs-mulai-display');
		cs_mulai_display.bind('cs-mulai-display-event', function(data) {

			$('.antrian_cs_update').empty();
			
			var queryNomorAntrian = "C " + data.antrian_nomor;
		
			$('.antrian_cs_update').append(queryNomorAntrian);
			
		});
		// update ketika cs klik selesai 
		var cs_selesai_display = pusher.subscribe('cs-selesai-display');
		cs_selesai_display.bind('cs-selesai-display-event', function(data) {

			$('.antrian_cs_update').empty();
			
			var keterangan = data.keterangan;
		
			$('.antrian_cs_update').append(keterangan);
			
		});

		var desain_display = pusher.subscribe('desain-display');
		desain_display.bind('desain-display-event', function(data) {

			$('.antrian_desain').empty();
			
			var queryNomorAntrian = data.antrian_nomor;
		
			$('.antrian_desain').append(queryNomorAntrian);
			
		});		

		var desain_status = pusher.subscribe('desain-status');
		desain_status.bind('desain-status-event', function(data) {

			if (data.status == 1) {
				$(".desain .header-desain-satu").css("background-color", "#5cb85c");
			}
			if (data.status == 2) {
				$(".desain .header-desain-dua").css("background-color", "#5cb85c");
			}
			if (data.status == 3) {
				$(".desain .header-desain-tiga").css("background-color", "#5cb85c");
			}
			if (data.status == 4) {
				$(".desain .header-desain-empat").css("background-color", "#5cb85c");
			}
			if (data.status == 5) {
				$(".desain .header-desain-lima").css("background-color", "#5cb85c");
			}
			if (data.status == 6) {
				$(".desain .header-desain-enam").css("background-color", "#5cb85c");
			}
			
		});
	</script>
	<style>
		.cs .card-header {
			background-color: #fbdd23;
			text-align: center;
		}
		.cs .card-header .title {
			text-align: center;
			margin: 0;
			text-transform: uppercase;
			font-weight: bold;
		}
		.cs .card-body .number {
			font-size: 5em;
			font-family: 'arial';
			font-weight: bold;
			text-align: center;
		}
		.cs .card-footer .title {
			text-align: center;
			margin: 0;
			text-transform: uppercase;
			font-weight: bold;
		}

		.desain .card-header {
			background-color: #fbdd23;
			text-align: center;
		}
		.desain .card-header .title {
			text-align: center;
			margin: 0;
			text-transform: uppercase;
			font-weight: bold;
		}
		.desain .card-body .number {
			font-size: 3em;
			font-family: 'arial';
			font-weight: bold;
			text-align: center;
		}
	</style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="">
        <div class="row cs">
          <div class="col-lg-8">
            <div class="card">
                <iframe width="100%" height="500px" src="https://www.youtube.com/embed/KFEI6xyhYpI?playlist=KFEI6xyhYpI&loop=1">
								</iframe>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-4" style="height: 500px;">
            <div class="card" style="height: 240px;">
              <div class="card-header">
                <h5 class="title">Nomor Antrian</h5>
              </div>
              <div class="card-body">
                <p class="number antrian_cs_selesai">C <span class="antrian_cs">0</span></p>
							</div>
							<div class="card-footer">
								<h5 class="title">Total Antrian <span class="antrian_total_cs">0</span></h5>
							</div>
            </div>

            <div class="card" style="height: 240px;">
              <div class="card-header">
                <h5 class="title">Nomor Antrian</h5>
              </div>
              <div class="card-body">
                <p class="number">D <span class="antrian_desain">0</span></p>
							</div>
							<div class="card-footer">
								<h5 class="title">Total Antrian <span class="antrian_total_desain">0</span></h5>
							</div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
				<!-- /.row -->
				<div class="row desain">
					<div class="col-lg-2">
						<div class="card" style="height: 200px;">
              <div class="card-header header-desain-satu">
                <h5 class="title desain-satu">Desain 1</h5>
              </div>
              <div class="card-body">
                <p class="number">-</p>
							</div>
            </div>
					</div>
					<div class="col-lg-2">
						<div class="card" style="height: 200px;">
              <div class="card-header header-desain-dua">
                <h5 class="title desain-dua">Desain 2</h5>
              </div>
              <div class="card-body">
                <p class="number">-</p>
							</div>
            </div>
					</div>
					<div class="col-lg-2">
						<div class="card" style="height: 200px;">
              <div class="card-header header-desain-tiga">
                <h5 class="title desain-tiga">Desain 3</h5>
              </div>
              <div class="card-body">
                <p class="number">-</p>
							</div>
            </div>
					</div>
					<div class="col-lg-2">
						<div class="card" style="height: 200px;">
              <div class="card-header header-desain-empat">
                <h5 class="title desain-empat">Desain 4</h5>
              </div>
              <div class="card-body">
                <p class="number">-</p>
							</div>
            </div>
					</div>
					<div class="col-lg-2">
						<div class="card" style="height: 200px;">
              <div class="card-header header-desain-lima">
                <h5 class="title desain-lima">Desain 5</h5>
              </div>
              <div class="card-body">
                <p class="number">-</p>
							</div>
            </div>
					</div>
					<div class="col-lg-2">
						<div class="card" style="height: 200px;">
              <div class="card-header header-desain-enam">
                <h5 class="title desain-enam">Desain 6</h5>
              </div>
              <div class="card-body">
                <p class="number">-</p>
							</div>
            </div>
					</div>
				</div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
