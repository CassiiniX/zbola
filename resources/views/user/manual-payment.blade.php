@extends("user.layout.default")

@section("title")
Pembayaran Manual
@endsection
<style>
.main-image {
	cursor:pointer;
	height:200px;
	object-fit:cover;
}
.description {
	background:#eee
}
</style>
@section("sc_header")
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Pembayaran Manual</h3>
		</div>

		<div class="float-right">
			<form>
				<input type="text" class="form-control" placeholder="Search . . ." value="{{$search}}"
					name="search"
					onkeyup="event.key == 13 ? this.form.submit() : ''">
			</form>
		</div>
	</div>

	@if(!count($manualPayment))
	<div class="card">
		<div class="card-body">
			<div class="col-md-5 m-auto text-center">
				<img src="{{asset('assets/images/404.png')}}"
					class="img-fluid">
				<h5>Data pembayaran manual tidak ditemukan</h5>
			</div>
		</div>
	</div>
	@endif

	<div class="row">
		@foreach($manualPayment as $item)
		<div class="col-md-3">
			<div class="card">
				<img class="card-img-top main-image" 
					src="{{ asset('assets/images/proofs/'.$item->proof) }}"
					onclick="window.location='{{ asset('assets/images/proofs/'.$item->proof) }}'">		

				<div class="card-body">
					<div class="p-1 mb-4">
						<a href="{{url('user/product/'.$item->invoice->product->id)}}">
							{{ucwords($item->invoice->product->address)}}
						</a>
					</div>

					<div class="p-3 mb-2 description">
						{{ucwords($item->description)}}
					</div>					

					<div class="clearfix">
						<div class="float-left">
							@if($item->status == "validasi")
							 <span class="badge badge-primary">
							 	Validasi
							 </span>
							@elseif($item->status == "success")
							 <span class="badge badge-success">
							 	Berhasil
							 </span>
							@elseif($item->status == "failed")
							 <span class="badge badge-danger">
							 	Gagal
							 </span>
							@endif
						</div>

						<div class="float-right">
							{{$item->get_human_created_at}}
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

	<div class="col-12">
       {{$manualPayment->links()}}
   	</div>
</div>
@endSection