@extends("user.layout.default")

@section("title")
	Notifikasi
@endsection

@section("sc_header")
<style>
.font-size-50{
	font-size: 50px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Riwayat Notifikasi</h3>
		</div>

		<div class="float-right">
			<form>
				<input type="text" class="form-control" placeholder="Search . . ." value="{{$search}}"
					name="search"
					onkeyup="event.key == 13 ? this.form.submit() : ''">
			</form>
		</div>
	</div>

	@if(!count($notification))
	<div class="card">
		<div class="card-body">
			<div class="col-md-5 m-auto text-center">
				<img src="{{asset('assets/images/404.png')}}"
					class="img-fluid">
				<h5>Data notifikasi tidak ditemukan</h5>
			</div>
		</div>
	</div>
	@endif

	@foreach($notification as $item)
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class='col-md-1'>
					<div class="clearfix">
						<div class="float-left">
							<i class='fe fe-bell font-size-50'></i>
						</div>
						<div class="float-right d-block d-md-none">
							{{$item->get_human_created_at}}
						</div>
					</div>
				</div>

				<div class="col-md-11 pl-0">
					<div class="row">
						<div class="col-12">
							<div class="clearfix">
								<div class="float-left">
									<b>{{$item->title}}</b>
								</div>
								<div class="float-right d-none d-md-block">
									{{$item->get_human_created_at}}
								</div>
							</div>
						</div>
						<div class="col-12">
							{{$item->content}}
						</div>												
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach

	<div class="col-12">
       {{$notification->links()}}
   	</div>
</div>
@endSection