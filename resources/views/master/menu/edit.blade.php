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
									<label for="nama_menu">Nama Menu</label>
									<input type="text" name="nama_menu" class="form-control @error('nama_menu') is-invalid @enderror" id="nama_menu" placeholder="Masukkan nama menu" required value="{{ $menu->nama_menu }}">
								</div>

								@error('nama_menu')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror

								<div class="form-group">
									<div class="form-group">
										<label for="level_menu">Level Menu</label>
										<select id="level_menu" class="form-control" name="level_menu">
											<option value="main_menu" {{ $menu->level_menu == "main_menu" ? "selected" : "" }}>Main Menu</option>
											<option value="sub_menu" {{ $menu->level_menu == "sub_menu" ? "selected" : "" }}>Sub Menu</option>
										</select>
									</div>
								</div>

								<div class="form-group" id="form_root_menu" style="display: none;">
									<label for="root_menu">Root Menu</label>
									<select id="root_menu" class="form-control" name="root_menu">
										<option value="">--Pilih Root Menu--</option>
										@foreach ($root_menus as $root_menu)
												<option value="{{ $root_menu->id }}" {{ $root_menu->id == $menu->root_menu ? "selected" : "" }}>{{ $root_menu->nama_menu }}</option>
										@endforeach
									</select>
								</div>

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

	var level_menu = $('#level_menu').val();

	if (level_menu == "sub_menu") {
		$('#form_root_menu').css('display', 'block');
	} else {
		$('#form_root_menu').css('display', 'none');
	}

	$('#level_menu').on('change', function() {
		var level_menu_change = $('#level_menu').val();

		if (level_menu_change == "sub_menu") {
			$('#form_root_menu').css('display', 'block');
		} else {
			$('#form_root_menu').css('display', 'none');
		}
	})
});
</script>

@endsection