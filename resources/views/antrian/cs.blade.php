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

	.antrian {
		width: 100%;
		height: 100%;
		border: #000 2px solid;
	}

	.antrian .nomor {
		margin: 0;
		padding: 0;
		font-size: 5em;
		text-align: center;
		font-weight: bold;
		font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
	}
	.antrian .desainer {
		margin: 0;
		padding: 0;
		text-align: center;
		font-weight: bold;
		font-size: 2em;
	}

	.no_antrian {
		width: 100%;
		height: 100%;
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
								<div class="col-md-8">
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
								</div>
								<div class="col-md-4">
									<div class="antrian">
										<p class="nomor">35</p>
										<p class="desainer">DESAINER 2</p>
									</div>
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