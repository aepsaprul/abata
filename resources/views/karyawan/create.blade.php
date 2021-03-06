@extends('layouts.app')

@section('content')
	
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Tambah Karyawan</h1>
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
							<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/karyawan') }}">BACK</a></h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="card-body">
								<div class="form-group">
									<label for="nama_lengkap">Nama Lengkap</label>
									<input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Masukkan nama lengkap" required autofocus value="{{ old('nama_lengkap') }}">
								</div>

								@error('nama_lengkap')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
								<div class="form-group">
									<label for="alamat">Alamat</label>
									<input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat" required autofocus value="{{ old('alamat') }}">
								</div>

								@error('alamat')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
								<div class="form-group">
									<label for="email">Email</label>
									<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" required autofocus value="{{ old('email') }}">
								</div>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
								<div class="form-group">
									<label for="telepon">telepon</label>
									<input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" id="telepon" placeholder="Masukkan telepon" required autofocus value="{{ old('telepon') }}">
								</div>

								@error('telepon')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
								<div class="form-group">
									<label for="jabatan_id">Jabatan</label>
									<select name="jabatan_id" id="jabatan_id" class="form-control">
										@foreach ($jabatans as $jabatan)
											<option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
										@endforeach
									</select>
								</div>
								
								<div class="form-group">
									<label for="foto">Foto</label>
									<input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" required autofocus value="{{ old('foto') }}">
								</div>
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