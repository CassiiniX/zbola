@extends("admin.layout.default")

@section("title")
Laporan
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Kelola Laporan</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="card-body text-center">
					<form method="get" action="{{url('admin/report/invoice')}}" target="_blank">
						<div class='form-group'>
							<input type="date" name="start_date" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="date" name="end_date" class="form-control" required>
						</div>

						<button class="btn btn-success mt-3">
							<i class='fe fe-clipboard'></i>
							Buat laporan invoice					
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endSection