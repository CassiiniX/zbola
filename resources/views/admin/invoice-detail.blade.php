@extends("admin.layout.default")

@section("title")
  Inovice Detail
@endsection

@section("content")
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-borderless">
							<tr>
								<td colspan="2">
									<img src="{{asset('assets/images/invoice-'.$invoice->status.'.png')}}"
										class="img-fluid">									
								</td>
							</tr>
							<tr>
								<td>Invoice Id</td>
								<td>{{$invoice->id}}</td>
							</tr>
							<tr>
								<td>User</td>
								<td>
									<a href="{{url('admin/user?search='.$invoice->user->username)}}" target="_blank">
										{{$invoice->user->username}}
									</a>
								</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>
								  @if($invoice->status == "pending") 
						           <span class="badge badge-warning">
						           	Pending
						           </span>
						          @elseif($invoice->status == "payment")
						           <span class="badge badge-success">
						           	Pembayaran
						           </span>
						          @elseif($invoice->status == "waiting")
						           <span class="badge badge-warning">
						           	Menunggu
						           </span>
						          @elseif($invoice->status == "running")
						           <span class="badge badge-warning">
						           	Berjalan
						           </span>
						          @elseif($invoice->status == "failed")
						           <span class="badge badge-danger">
						           	Digagalkan
						           </span>
						          @elseif($invoice->status == "canceled")
						           <span class="badge badge-danger">
						           	Dibatalkan
						           </span>
						          @elseif($invoice->status == "rejected")
						           <span class="badge badge-danger">
						           	Ditolak
						           </span>
						          @elseif($invoice->status == "compeleted")
						           <span class="badge badge-success">
						           	Selesai
						           </span>
						          @endif
								</td>
							</tr>
							<tr>
								<td>Awal Mulai</td>
								<td>{{$invoice->start_rent}}</td>
							</tr>
							<tr>
								<td>Jam</td>
								<td>{{$invoice->hour}} Jam</td>
							</tr>
							<tr>
								<td>Total</td>
								<td>Rp.{{number_format($invoice->total,2)}}</td>
							</tr>
							<tr>
								<td>Dibuat</td>
								<td>{{$invoice->get_human_created_at}}</td>
							</tr>
							<tr>
								<td colspan="2" class="text-center">
									@if($invoice->status == "pending")
										<button class="btn btn-success"
											onclick="window.location='{{url('admin/invoice/approve/'.$invoice->id)}}'">
											<i class='fe fe-check'></i> 
											Terima
										</button>
										<button class="btn btn-danger"
											onclick="rejectedOrder('{{url('admin/invoice/rejected/'.$invoice->id)}}')">
											<i class='fe fe-x'></i> 
											Tolak 
										</button>
									@endif		

									@if($invoice->status == "payment")							
										@if($isLate)
											<button class="btn btn-danger"
												onclick="failedOrder('{{url('admin/invoice/failed/'.$invoice->id)}}')">
												<i class='fe fe-x'></i> 
												Gagalkan
											</button>

											<div class="alert alert-info mt-2">
												User telat membayar,Anda harus mengagalkan pesanan
											</div>
										@else										
											<div class="alert alert-info">
												Untuk mengubah status sekarang 
												dapat dilakukan pada halaman detail pembayaran
											<div>
										@endif
									@endif

									@if($invoice->status == "waiting")
										<button class="btn btn-success"
											onclick="window.location='{{url('admin/invoice/waiting/'.$invoice->id)}}'">
											Ubah menjadi berjalan
										</button>
									@endif

									@if($invoice->status == "running")
										<button class="btn btn-success"
											onclick="window.location='{{url('admin/invoice/running/'.$invoice->id)}}'">
											Ubah menjadi selesai
										</button>
									@endif
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-5">
								<img src="{{asset('assets/images/products/'.$invoice->product->get_images[0])}}"
									class="img-fluid"/>

								<div class="d-flex flex-row">
									@foreach($invoice->product->get_images as $item)
										<img src="{{asset('assets/images/products/'.$item)}}"
											style="height:50px" class="mt-2 ml-2" onclick="window.location='{{asset('assets/images/products/'.$item)}}'">		
									@endforeach
								</div>		
							</div>
							<div class="col-md-7">
								<div class="table-responsive">
									<table class="table table-borderless">
										<tr>
											<td>Alamat</td>
											<td>
												<a href="{{url('admin/product?search='.$invoice->product->address)}}"
													target="_blank">
													{{$invoice->product->address}}
												</a>
											</td>
										</tr>
										<tr>
											<td>Harga</td>
											<td>Rp.{{number_format($invoice->product->price,2)}} Perjam</td>
										</tr>
										<tr>
											<td>Status</td>
											<td>
												@if($invoice->product->rent)
													<span class="badge badge-danger">
														Tersewa
													</span>
												@else
													<span class="badge badge-success">
														Berlum Tersewa
													</span>
												@endif
											</td>
										</tr>
										<tr>
											<td colspan="2">
												{!! $invoice->product->get_star !!}
											</td>
										</tr>
									</table>
								</diV>
							</div>
						</div>
					</div>
				</div>
			</div>

			@if(count($invoice->manual_payment))
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-borderless"> 
									<tr class="bg-primary text-white">
										<td>Id</td>
										<td class="text-center">Bukti</td>
										<td>Deskripsi</td>
										<td>Status</td>
										<td>Dibuat</td>
									</tr>							

									@foreach($invoice->manual_payment as $item)
									<tr>
										<td>
											<a href="{{url('admin/manual-payment/detail/'.$item->id)}}">
												{{$item->id}}
											</a>
										</td>
										<td class="text-center">
											<a href="{{asset('assets/images/proofs/'.$item->proof)}}" target="_blank">
												<img src="{{asset('assets/images/proofs/'.$item->proof)}}"
													width="100px">
											</a>
										</td>
										<td>{{$item->description}}</td>
										<td>										
											@if($item->status == "validasi")
											 <span class="badge badge-primary">
											 	Validasi
											 </span>
											@elseif($item->status == "failed")
											 <span class="badge badge-danger">
											 	Gagal
											 </span>
											@elseif($item->status == "success")
											 <span class="badge badge-success">
											 	Berhasil
											 </span>
											@endif
										</td>
										<td>{{$item->get_human_created_at}}</td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
@endSection


@section("sc_footer")
<script>
function rejectedOrder(action){
	swal.fire({
    	title: 'Apakah Anda Yakin?',
    	text: 'Menolak Pesanan Ini',
    	icon: 'warning',
    	confirmButtonColor: '#fe7c96',
    	showCancelButton: true,
    	confirmButtonText: 'Oke',
    	showLoaderOnConfirm: true,
    	cancelButtonText: 'Batal',      
  	})
  	.then(result => {
	  	if(result.value){  	 	
  	 		window.location = action;
  		}
  	})
}

function failedOrder(action){
	swal.fire({
    	title: 'Apakah Anda Yakin?',
    	text: 'Mengagalkan Pesanan Ini',
    	icon: 'warning',
    	confirmButtonColor: '#fe7c96',
    	showCancelButton: true,
    	confirmButtonText: 'Oke',
    	showLoaderOnConfirm: true,
    	cancelButtonText: 'Batal',      
  	})
  	.then(result => {
	  	if(result.value){  	 	
  	 		window.location = action;
  		}
  	})
}
</script>
@endSection