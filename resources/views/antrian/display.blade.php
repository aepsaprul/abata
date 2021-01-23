@extends('layouts.app')

@section('style')

<style>
	.layer-1 {
		margin-top: 30px;
	}
	.promo {
		height: 400px;
		border: 2px solid #000;
	}

	.status {
		height: 400px;
		border: 2px solid #000;
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
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="promo">
										<iframe width="100%" height="100%" src="https://www.youtube.com/embed/lpeBqjQAWBo?playlist=lpeBqjQAWBo&loop=1">
										</iframe>										
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="status">status</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col">
									<p class="desain">Desain 1</p>
								</div>
								<div class="col">
									<p class="desain">Desain 2</p>
								</div>
								<div class="col">
									<p class="desain">Desain 3</p>
								</div>
								<div class="col">
									<p class="desain">Desain 4</p>
								</div>
							</div>
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