@extends('layouts.app')

@section('style')

<style>
	.layer-1 {
		margin-top: 30px;
		margin-bottom: 30px;
	}

	.komputer {
		width: 100%;
		height: 100px;
		border: #000 2px solid;
	}

	.no_antrian {
		width: 100%;
		height: 100px;
		border: #000 2px solid;
	}

	.desain {
		width: 100%;
		height: 100px;
		border: #000 2px solid;
	}
</style>

@endsection

@section('content')
	
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="container layer-1">
							<div class="row">
								<div class="col">
									<p class="komputer">K1</p>
								</div>
								<div class="col">
									<p class="komputer">K1</p>
								</div>
								<div class="col">
									<p class="komputer">K1</p>
								</div>
								<div class="col">
									<p class="komputer">K1</p>
								</div>
								<div class="col">
									<p class="komputer">K1</p>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<p class="no_antrian">1</p>
								</div>
								<div class="col">
									<p class="no_antrian">2</p>
								</div>
								<div class="col">
									<p class="no_antrian">3</p>
								</div>
								<div class="col">
									<p class="no_antrian">4</p>
								</div>
								<div class="col">
									<p class="no_antrian">5</p>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col">
									<p class="desain">File Siap</p>
								</div>
								<div class="col">
									<p class="desain">File Edit</p>
								</div>
								<div class="col">
									<p class="desain">File Desain</p>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
									<button class="btn btn-info btn-block">Timer</button>
								</div>
								<div class="col-sm-4"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /.card-body -->
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

@endsection