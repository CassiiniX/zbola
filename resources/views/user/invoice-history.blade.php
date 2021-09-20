@extends("user.layout.default")

@section("title")
Riwayat Invoice
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Riwayat Invoice</h3>
		</div>

		<div class="float-right">
			<form>
				<input type="text" class="form-control" placeholder="Search . . ." value="{{$search}}"
					name="search"
					onkeyup="event.key == 13 ? this.form.submit() : ''">
			</form>
		</div>
	</div>

	@if(!count($invoice))
	<div class="card">
		<div class="card-body">
			<div class="col-md-5 m-auto text-center">
				<img src="{{asset('assets/images/404.png')}}"
					class="img-fluid">
				<h5>Data invoice tidak ditemukan</h5>
			</div>
		</div>
	</div>
	@endif

	@foreach($invoice as $item)
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class='col-3'>
					<img src="{{asset('assets/images/products/'.$item->product->get_images[0])}}"
						class="img-fluid">
				</div>

				<div class="col-9">
					<div class="row">
						<div class="col-12">
							<div class="clearfix">
								<div class="float-left">
									<a href="{{url('user/product/'.$item->product->id)}}">
										<h4>
											{{ucwords($item->product->address)}}
										</h4>
									</a>
								</div>

								<div class="float-right">
									@if($item->status == "pending")	
									 <span class="badge badge-warning">
									 	Pending
									 </span>
									@elseif($item->status == "waiting")
									 <span class="badge badge-warning">
									 	Menunggu
									 </span>
									@elseif($item->status == "payment")
									 <span class="badge badge-success">
									 	Pembayaran
									 </span>
									@elseif($item->status == "running")
									 <span class="badge badge-warning">
									 	Berjalan
									 </span>
									@elseif($item->status == "canceled")
									 <span class="badge badge-danger">
									 	Dibatalkan
									 </span>
									@elseif($item->status == "failed")
									 <span class="badge badge-danger">
									 	Digagalkan
									 </span>
									@elseif($item->status == "rejected")
									 <span class="badge badge-danger">
									 	Ditolak
									 </span>
									@elseif($item->status == "compeleted")
									 <span class="badge badge-success">
									 	Selesai
									 </span>
									@endif
								</div>
							</div>
						</div>

						<div class="col-12">
							<h5 class='text-success'>
								Rp.{{number_format($item->product->price,2)}} Perjam
							</h5>
						</div>
					
						<div class="col-12 mt-2">
							<b>
								Total : Rp.{{number_format($item->total,2)}} - ({{$item->hour}} Jam)
							</b>
						</div>

						<div class="col-12 mt-5">
							<div class="clearfix">									
								<div class="float-left">
									<b>
										Tanggal Mulai : {{$item->start_rent}}
									</b>
								</div>
								<div class="float-right">
									<b>
										Dibuat Pada : {{$item->created_at}}
									</b>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach

	<div class="col-12">
       {{$invoice->links()}}
   	</div>
</div>
@endSection