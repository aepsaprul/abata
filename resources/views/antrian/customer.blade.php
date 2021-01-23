@extends('layouts.app')

@section('style')

<style>
	.layer-1 {
		margin-top: 30px;
		margin-bottom: 30px;
		height: 450px;
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
							<table style="height: 100%; width: 100%;">
								<tbody>
									<tr>
										<td class="align-middle text-center">
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-4">
													<a href="#" class="btn btn-primary btn-block pl-5 pr-5 pt-4 pb-4 font-weight-bold">DESAIN SIAP</a>
												</div>
												<div class="col-md-4"></div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-4">
													<a href="#" class="btn btn-info btn-block pl-5 pr-5 pt-4 pb-4 font-weight-bold">DESAIN BARU</a>
												</div>
												<div class="col-md-4"></div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
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