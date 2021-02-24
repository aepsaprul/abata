
@extends('layouts.app')

@section('style')

<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

@endsection
		

@section('content')

<div class="wrapper"> 

  <!-- Main Sidebar Container --> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengunjung</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pengunjung</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2">
						<!-- Date -->
						<div class="form-group">
							<label>Date:</label>
								<div class="input-group date" id="reservationdate" data-target-input="nearest">
										<input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
										<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
								</div>
						</div>
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->

				<div class="row">
					<div class="col-12">
						@if(session('status'))
							<div class="alert alert-success">
									{{session('status')}}
							</div>
						@endif
						<div class="card">
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Telepon</th>
										<th>Jenis</th>
									</tr>
									</thead>
									<tbody>
										@foreach ($visitors as $key => $visitor)
											
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $visitor->nama_customer }}</td>
												<td>{{ $visitor->telepon }}</td>
												<td>
                          @if ($visitor->customer_filter_id == "1")
                            File Siap
                          @elseif ($visitor->customer_filter_id == "2")
                            Desain / Edit
                          @elseif ($visitor->customer_filter_id == "3")
                            Konsultasi
                          @elseif ($visitor->customer_filter_id == "4")
                            Desain
                          @elseif ($visitor->customer_filter_id == "5")
                            Edit
                          @endif
                        </td>
											</tr>
										
										@endforeach
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->

@endsection

@section('script')

<!-- InputMask -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Page script -->
<script>
  $(function () {
    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

  })
</script>

<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection

