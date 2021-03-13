
@extends('layouts.app')

@section('style')

<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">


<style>
  table thead tr th {
    text-align: center;
  }
</style>

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
          <div class="col-md-3">
						<!-- Date -->
						<div class="form-group">
              <label>Date range:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" id="reservation">
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <!-- /.col (right) -->
          <div class="col-md-3">
            <div class="form-group">
              <label>Cabang:</label>

              <select data-column="5" name="" id="" class="form-control filter-cabang">
                <option value="">Semua Cabang</option>
                <option value="2">Situmpur</option>
                <option value="3">HR</option>
                <option value="4">DKW</option>
                <option value="5">Purbalingga</option>
                <option value="6">Cilacap</option>
              </select>
            </div>
          </div>
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
								<table id="datatable" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Telepon</th>
										<th>Jenis Cetak</th>
										<th>Nama Desain / CS</th>
										<th>Tanggal</th>
										<th>Cabang</th>
									</tr>
									</thead>
									<tbody id="data-pengunjung">
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
    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'DD/MM/YYYY'
      }
    })
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'DD/MM/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

  })
</script>

<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>



<!-- DataTables -->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"> </script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>

<script>
  $(document).ready(function(){
    var table = $('#datatable').DataTable({
      pageLength: 25,
      processing: true,
      serverSide: true,
      dom: '<"html5buttons">Blfrtip',
      
      buttons : [
                  {extend:'csv'},
                  {extend: 'pdf', title:'Contoh File PDF Datatables'},
                  {extend: 'excel', title: 'Contoh File Excel Datatables'},
                  {extend:'print',title: 'Contoh Print Datatables'},
      ],
      ajax: "{{ route ('laporan.pengunjung.data') }}",
      columns: [
          {"data":"id"},
          {"data":"nama_customer"},
          {"data":"telepon"},
          {"data":"customer_filter_id",
            render: function (data, type, row) {
              if (data == 1) {
                return 'File siap';
              } else if (data == 2) {
                return 'Desain / Edit';
              } else if (data == 3) {
                return 'Konsultasi CS';
              } else if (data == 4) {
                return 'Desain';
              } else if (data == 5) {
                return 'Edit';
              }
            }
          },
          {"data":"nama_karyawan"},
          {"data":"tanggal",
            render: function (data, type, row) {
              return convertDateTimeDBtoIndo(data);
            }
          },
          {"data":"master_cabang_id",
            render: function (data, type, row) {
              if (data == 2) {
                return 'Situmpur';
              } else if (data == 3) {
                return 'HR';
              } else if (data == 4) {
                return 'DKW';
              } else if (data == 5) {
                return 'Purbalingga';
              } else if (data == 6) {
                return 'Cilacap';
              }
            }
          },
      ],
      // columnDefs : [{
      //     render : function (data,type,row){
      //         return data + ' - ' + row['telepon'] + ''; 
      //     },
      //     "targets" : 1
      //     },
      //     {"visible": false, "targets" : 2}
      // ],
    });    

    //filter Berdasarkan cabang
    $('.filter-cabang').change(function () {
        table.column( $(this).data('column'))
        .search( $(this).val() )
        .draw();
    });
  });
</script>

<script>
  $(document).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // dataPengunjung();
    
    // function dataPengunjung() {
    //   $('#data-pengunjung').empty();

    //   $.ajax({
    //     url: '{{ URL::route('laporan.pengunjung.data') }}',
    //     type: 'GET',
    //     data: {
    //       _token: CSRF_TOKEN
    //     },
    //     success: function(response) {
    //       $.each(response.visitors, function(i, value) {

    //         var created_at = value.created_at;
    //         var created_at_replace = created_at.replace(/T|.000000Z/g, " ");
    //         var tgl = new Date(created_at_replace);
    //         var hari = tgl.getDate(); 
    //         var bulan = tgl.getMonth();

    //         if (value.customer_filter_id == '1') {
    //           var customer_filter_id = "File Siap";
    //         } else if (value.customer_filter_id == '2') {
    //           var customer_filter_id = "Desain / Edit";
    //         } else if (value.customer_filter_id == '3') {
    //           var customer_filter_id = "Konsultasi CS";
    //         } else if (value.customer_filter_id == '4') {
    //           var customer_filter_id = "Desain";
    //         } else if (value.customer_filter_id == '5') {
    //           var customer_filter_id = "Desain";
    //         }

    //         var dataPengunjungs = "<tr><td>" + (i + 1) + "</td><td>" + value.nama_customer + "</td><td>" + value.telepon + "</td><td>" + customer_filter_id + "</td><td>" + convertDateTimeDBtoIndo(created_at_replace) + "</td></tr>";

    //         $('#data-pengunjung').append(dataPengunjungs);
    //       })
    //     }
    //   });
    // }

    $('.applyBtn').on('click', function() {
      var start = $('#reservation').data('daterangepicker').startDate.format('D M YYYY');
      var end = $('#reservation').data('daterangepicker').endDate.format('D M YYYY');
      console.log(start + " ---- " + end);
      // console.log(startDate.format('D MMMM YYYY') + ' - ' + endDate.format('D MMMM YYYY'));
    });

  });
</script>

@endsection

