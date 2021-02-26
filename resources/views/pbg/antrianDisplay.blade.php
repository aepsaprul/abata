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
		// customer ke  total cs display 
		var channel = pusher.subscribe('customer-cs-display');
		channel.bind('customer-cs-display-event', function(data) {

			$('.antrian_total_cs').empty();
			
			var queryNomorAntrian = data.antrian_total;
		
			$('.antrian_total_cs').append(queryNomorAntrian);
			
		});
		// customer ke total desain display
		var desain_channel = pusher.subscribe('customer-desain-display');
		desain_channel.bind('customer-desain-display-event', function(data) {

			$('.antrian_total_desain').empty();
			
			var queryNomorAntrian = data.antrian_total;
		
			$('.antrian_total_desain').append(queryNomorAntrian);
			
		});
		// cs ke display ketika klik panggil
		var cs_display = pusher.subscribe('cs-display');
		cs_display.bind('cs-display-event', function(data) {

			$('.antrian_cs').empty();
			$('.number-cs').empty();
			
			var queryNomorAntrian = "C " + data.antrian_nomor;
		
			$('.antrian_cs').append(queryNomorAntrian);
			$('.number-cs').append(queryNomorAntrian);
			
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

			$('.desain .number-cs').empty();
			
			var keterangan = data.keterangan;
		
			$('.desain .number-cs').append(keterangan);
			
		});

		// desain ke display ketika klik panggil 
		var desain_display = pusher.subscribe('desain-display');
		desain_display.bind('desain-display-event', function(data) {

			$('.antrian_desain').empty();			
			var queryNomorAntrian = "D " + data.antrian_nomor;		
			$('.antrian_desain').append(queryNomorAntrian);

			if (data.desain_nomor == 1) {
				$('.desain .number-satu').empty();			
				var queryNomorAntrian = "D " + data.antrian_nomor;		
				$('.desain .number-satu').append(queryNomorAntrian);
			}
			if (data.desain_nomor == 2) {
				$('.desain .number-dua').empty();			
				var queryNomorAntrian = "D " + data.antrian_nomor;		
				$('.desain .number-dua').append(queryNomorAntrian);
			}
			if (data.desain_nomor == 3) {
				$('.desain .number-tiga').empty();			
				var queryNomorAntrian = "D " + data.antrian_nomor;		
				$('.desain .number-tiga').append(queryNomorAntrian);
			}
			if (data.desain_nomor == 4) {
				$('.desain .number-empat').empty();			
				var queryNomorAntrian = "D " + data.antrian_nomor;		
				$('.desain .number-empat').append(queryNomorAntrian);
			}
			
		});
		// update ketika desainer klik mulai 
		var desain_mulai_display = pusher.subscribe('desain-mulai-display');
		desain_mulai_display.bind('desain-mulai-display-event', function(data) {

			if (data.desain_nomor == 1) {
				$('.desain .number-satu').empty();			
				var queryNomorAntrian = "D " + data.antrian_nomor;		
				$('.desain .number-satu').append(queryNomorAntrian);
			}
			if (data.desain_nomor == 2) {
				$('.desain .number-dua').empty();			
				var queryNomorAntrian = "D " + data.antrian_nomor;		
				$('.desain .number-dua').append(queryNomorAntrian);
			}
			if (data.desain_nomor == 3) {
				$('.desain .number-tiga').empty();			
				var queryNomorAntrian = "D " + data.antrian_nomor;		
				$('.desain .number-tiga').append(queryNomorAntrian);
			}
			if (data.desain_nomor == 4) {
				$('.desain .number-empat').empty();			
				var queryNomorAntrian = "D " + data.antrian_nomor;		
				$('.desain .number-empat').append(queryNomorAntrian);
			}
			
		});
		// update ketika desainer klik selesai 
		var desain_selesai_display = pusher.subscribe('desain-selesai-display');
		desain_selesai_display.bind('desain-selesai-display-event', function(data) {

			if (data.desain_nomor == 1) {
				$('.desain .number-satu').empty();			
				var keterangan = data.keterangan;		
				$('.desain .number-satu').append(keterangan);
			}
			if (data.desain_nomor == 2) {
				$('.desain .number-dua').empty();			
				var keterangan = data.keterangan;		
				$('.desain .number-dua').append(keterangan);
			}
			if (data.desain_nomor == 3) {
				$('.desain .number-tiga').empty();			
				var keterangan = data.keterangan;		
				$('.desain .number-tiga').append(keterangan);
			}
			if (data.desain_nomor == 4) {
				$('.desain .number-empat').empty();			
				var keterangan = data.keterangan;		
				$('.desain .number-empat').append(keterangan);
			}
			if (data.desain_nomor == 5) {
				$('.desain .number-lima').empty();			
				var keterangan = data.keterangan;		
				$('.desain .number-lima').append(keterangan);
			}
			
		});	

		// cs on / off 
		var cs_status = pusher.subscribe('cs-status');
		cs_status.bind('cs-status-event', function(data) {

			if (data.status == "on") {
				$(".desain .cs .card-footer p").append(data.nama_cs);
			} else {
				$(".desain .cs .card-footer p").empty();
			}

		});

		// desain on / off 
		var desain_status = pusher.subscribe('desain-status');
		desain_status.bind('desain-status-event', function(data) {

			if (data.desain_nomor == 1) {
				if (data.status == "on") {
					// $(".desain .header-desain-satu").css("background-color", "#7CFC00");
					$(".desain .desain-1 .card-footer p").append(data.nama_desain);
				} else {
					// $(".desain .header-desain-satu").css("background-color", "#fbdd23");
					$(".desain .desain-1 .card-footer p").empty();
				}
			}
			if (data.desain_nomor == 2) {
				if (data.status == "on") {
					// $(".desain .header-desain-dua").css("background-color", "#7CFC00");
					$(".desain .desain-2 .card-footer p").append(data.nama_desain);
				} else {
					// $(".desain .header-desain-dua").css("background-color", "#fbdd23");
					$(".desain .desain-2 .card-footer p").empty();
				}
			}
			if (data.desain_nomor == 3) {
				if (data.status == "on") {
					// $(".desain .header-desain-tiga").css("background-color", "#7CFC00");
					$(".desain .desain-3 .card-footer p").append(data.nama_desain);
				} else {
					// $(".desain .header-desain-tiga").css("background-color", "#fbdd23");
					$(".desain .desain-3 .card-footer p").empty();
				}
			}
			if (data.desain_nomor == 4) {
				if (data.status == "on") {
					// $(".desain .header-desain-empat").css("background-color", "#7CFC00");
					$(".desain .desain-4 .card-footer p").append(data.nama_desain);
				} else {
					// $(".desain .header-desain-empat").css("background-color", "#fbdd23");
					$(".desain .desain-4 .card-footer p").empty();
				}
			}
			if (data.desain_nomor == 5) {
				if (data.status == "on") {
					// $(".desain .header-desain-lima").css("background-color", "#7CFC00");
					$(".desain .desain-5 .card-footer p").append(data.nama_desain);
				} else {
					// $(".desain .header-desain-lima").css("background-color", "#fbdd23");
					$(".desain .desain-5 .card-footer p").empty();
				}
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

		.desain .col-lg-2 .card {
			height: 250px;
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
			color: black;
		}
		.desain .card-body p {
			font-size: 3em;
			font-family: 'arial';
			font-weight: bold;
			text-align: center;
		}
		.desain .card-footer p {
			text-align: center;
			margin: 0;
			padding: 0;
			text-transform: uppercase;
		}
	</style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #176BB3;">
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
                <iframe width="100%" height="640px" src="https://www.youtube.com/embed/KFEI6xyhYpI?playlist=KFEI6xyhYpI&loop=1">
								</iframe>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-4" style="height: 640px;">
            <div class="card" style="height: 310px;">
              <div class="card-header">
                <h5 class="title">Nomor Antrian</h5>
              </div>
              <div class="card-body">
                <p class="number antrian_cs_selesai"><span class="antrian_cs">C 0</span></p>
							</div>
							<div class="card-footer">
								<h5 class="title">Total Antrian <span class="antrian_total_cs">0</span></h5>
							</div>
            </div>

            <div class="card" style="height: 310px;">
              <div class="card-header">
                <h5 class="title">Nomor Antrian</h5>
              </div>
              <div class="card-body">
                <p class="number"><span class="antrian_desain">D 0</span></p>
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
					<div class="col-lg-2 cs">
						<div class="card">
              <div class="card-header header-cs">
                <h5 class="title cs">CS</h5>
              </div>
              <div class="card-body">
                <p class="number-cs">-</p>
							</div>
							<div class="card-footer footer">
								<p></p>
							</div>
            </div>
					</div>
					<div class="col-lg-2 desain-1">
						<div class="card">
              <div class="card-header header-desain-satu">
                <h5 class="title desain-satu">Desain 1</h5>
              </div>
              <div class="card-body">
                <p class="number-satu">-</p>
							</div>
							<div class="card-footer">
								<p></p>
							</div>
            </div>
					</div>
					<div class="col-lg-2 desain-2">
						<div class="card">
              <div class="card-header header-desain-dua">
                <h5 class="title desain-dua">Desain 2</h5>
              </div>
              <div class="card-body">
                <p class="number-dua">-</p>
							</div>
							<div class="card-footer">
								<p></p>
							</div>
            </div>
					</div>
					<div class="col-lg-2 desain-34">
						<div class="card">
              <div class="card-header header-desain-tiga">
                <h5 class="title desain-tiga">Desain 3</h5>
              </div>
              <div class="card-body">
                <p class="number-tiga">-</p>
							</div>
							<div class="card-footer">
								<p></p>
							</div>
            </div>
					</div>
					<div class="col-lg-2 desain-4">
						<div class="card">
              <div class="card-header header-desain-empat">
                <h5 class="title desain-empat">Desain 4</h5>
              </div>
              <div class="card-body">
                <p class="number-empat">-</p>
							</div>
							<div class="card-footer">
								<p></p>
							</div>
            </div>
					</div>
					<div class="col-lg-2 desain-5">
						<div class="card">
              <div class="card-header header-desain-lima">
                <h5 class="title desain-lima">Desain 5</h5>
              </div>
              <div class="card-body">
                <p class="number-lima">-</p>
							</div>
							<div class="card-footer">
								<p></p>
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
