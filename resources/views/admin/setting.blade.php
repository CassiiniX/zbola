@extends("admin.layout.default")

@section("title")
Setting
@endsection

@section("content")
<div class="container">
	<div class="card">
		<div class="card-body">
			<h4>Website Setting</h4>
			<form action="{{url('admin/setting')}}" method="post">
				{{csrf_field()}}
				
				<div class="form-group">
					<div class="mb-2">Nama Website : </div>
					<div>
						<input type="text" class="form-control" name="site_name" value="{{config('app.site_name')}}">
					</div>
				</div>

				<div class="form-group">
					<div class="mb-2">Hari Pembayaran : </div>
					<div>
						<input type="text" class="form-control" name="payment_day" value="{{config('app.payment_day')}}">
					</div>
				</div>

				<div class="form-group">
					<div class="mb-2">Max Jam Sewa : </div>
					<div>
						<input type="text" class="form-control" name="hours" value="{{config('app.hours')}}">
					</div>
				</div>

				<div class="form-group">
					<div class="mb-2">Maintaince : </div>
					<div>
						<select class="form-control" name="maintaince">							
							<option value="1" {{intval(config('app.maintaince')) == 1 ? 'selected' : ''}}>Ya</option>
							<option value="0" {{intval(config('app.maintaince')) == 0 ? 'selected' : ''}}>Tidak</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<button class="btn btn-success">Kirim</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endSection