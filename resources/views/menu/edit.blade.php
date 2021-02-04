@extends('layouts.app')

@section('content')
	
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Ubah Menu</h1>
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
							<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/menu') }}">BACK</a></h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="{{ route('menu.update', [$menu->id]) }}" method="POST">
							@method('PUT')
							@csrf
							<div class="card-body">
								<div class="form-group">
									<label for="title">Title</label>
									<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Masukkan title" required value="{{ $menu->title }}">
								</div>

								@error('title')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror

								<div class="form-group">
									<label for="link">Link</label>
									<input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Masukkan Link" required value="{{ $menu->link }}">
								</div>

								@error('link')
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