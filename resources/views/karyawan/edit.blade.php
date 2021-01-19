@extends('layouts.app')

@section('content')
	
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Ubah Karyawan</h1>
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
							<h3 class="card-title">Ubah Data Karyawan</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="{{ route('karyawan.update', [$karyawan->id]) }}" method="POST" enctype="multipart/form-data">
							@method('PUT')
							@csrf
							<div class="card-body">
								<div class="form-group">
									<label for="nama_lengkap">nama_lengkap Karyawan</label>
									<input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Masukkan nama_lengkap" required value="{{ $karyawan->nama_lengkap }}">
								</div>

								@error('nama_lengkap')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
								<div class="form-group">
									<label for="alamat">Alamat Karyawan</label>
									<input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat" required value="{{ $karyawan->alamat }}">
								</div>

								@error('alamat')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
								<div class="form-group">
									<label for="email">Email Karyawan</label>
									<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" required value="{{ $karyawan->email }}">
								</div>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
								<div class="form-group">
									<label for="telepon">Telepon Karyawan</label>
									<input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" id="telepon" placeholder="Masukkan telepon" required value="{{ $karyawan->telepon }}">
								</div>

								@error('telepon')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
								<div class="form-group">
									<label for="jabatan_id">Jabatan Karyawan</label>
									<input type="text" name="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror" id="jabatan_id" placeholder="Masukkan jabatan_id" required value="{{ $karyawan->jabatan_id }}">
								</div>

								@error('jabatan_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror

								@if ($karyawan->foto)
										<img src="{{ asset('../storage/app/public/' . $karyawan->foto) }}" style="max-width: 200px;">
								@else
										Foto tidak ada
								@endif
								
								<div class="form-group">
									<label for="foto">Foto</label>
									<input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" autofocus value="{{ old('foto') }}">
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