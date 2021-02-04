@extends('layouts.app')

@section('content')
	
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Ubah Desainer</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					@if(session('status'))
						<div class="alert alert-success">
								{{session('status')}}
						</div>
					@endif

					<!-- general form elements -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/desainer') }}">BACK</a></h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="{{ route('desainer.update', [$desainer->id]) }}" method="POST">
							@method('PUT')
							@csrf
							<div class="card-body">
								<div class="form-group">
									<label for="title">Title</label>
									<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Masukkan title" required value="{{ $desainer->title }}">
								</div>

								@error('title')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="form-group">
									<label for="karyawan_id">karyawan_id</label>
									<select name="karyawan_id" id="karyawan_id" class="form-control">
										<option value="">-- Pilih Karyawan--</option>
										@foreach ($karyawans as $karyawan)
											<option value="{{ $karyawan->id }}"
												{{ $karyawan->id == $desainer->karyawan_id ? 'selected' : ' ' }}
												>{{ $karyawan->nama_lengkap }}</option>
										@endforeach
									</select>
								</div>

								@error('karyawan_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
</div>
<!-- /.content-wrapper -->

@endsection

@section('script')

<!-- bs-custom-file-input -->
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

@endsection