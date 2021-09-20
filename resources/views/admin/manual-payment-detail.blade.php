@extends("admin.layout.default")

@section("title")
Detail Pembayaran Manual
@endsection

@section("content")
<div class='container'>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="table-repsonsive">
						<table class="table table-borderless">							
							<tr>
								<td colspan="2">
									<img src="{{asset('assets/images/payment.png')}}"
										class="img-fluid"/>
								</td>
							</tr>
							<tr>
								<td>Id</td>
								<td>
									{{$manualPayment->id}}
								</td>
							</tr>				
							<tr>
								<td>User</td>
								<td>
									<a href="{{url('admin/user?search='.$manualPayment->user->username)}}"
										target="_blank">
										{{$manualPayment->user->username}}
									</a>
								</td>
							</tr>
							<tr>
								<td>Bukti</td>
								<td class="text-center">
									<a href="{{asset('assets/images/proofs/'.$manualPayment->proof)}}" 
										target="_blank">
										<img src="{{asset('assets/images/proofs/'.$manualPayment->proof)}}"
											width="150px">									
									</a>
									<br/>
									<small class="text-muted">
										(*Klik untuk memperbesar gambar)
									</small>
								</td>
							</tr>
							<tr>
								<td>Deskripsi</td>
								<td>
									{{$manualPayment->description}}
								</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>
									@if($manualPayment->status == "validasi")
										<span class="badge badge-primary">
											Validasi
										</span>
									@elseif($manualPayment->status == "failed")
										<span class="badge badge-danger">
											Gagal
										</span>
									@elseif($manualPayment->status == "success")
										<span class="badge badge-success">
											Berhasil
										</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Dibuat</td>
								<td>
									{{$manualPayment->get_human_created_at}}
								</td>
							</tr>
							<tr>
								<td colspan="2" class="text-center">
									@if($manualPayment->status == "validasi")
										<button class="btn btn-danger"
											onclick="failedPayment('{{url('admin/manual-payment/failed/'.$manualPayment->id)}}')">
											<i class='fe fe-x'></i> 
											Gagal
										</button>

										<button class="btn btn-success"
											onclick="window.location='{{url('admin/manual-payment/success/'.$manualPayment->id)}}'">
											<i class='fe fe-check'></i> 
											Berhasil											
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
						<div class="table-reponsive">
							<table class="table table-borderless">
								<tr>
									<td colspan="2" 
										class="text-center">
										<div class="col-5 m-auto">
											<img src="{{asset('assets/images/invoice-'.$manualPayment->invoice->status.'.png')}}"
												class="img-fluid">	
										</div>
									</td>
								</tr>
								<tr>
									<td>Invoice</td>
									<td>
										<a href="{{url('admin/invoice?search='.$manualPayment->invoice_id)}}"
											target="_blank">
											{{$manualPayment->invoice_id}}
										</a>
									</td>
								</tr>
								<tr>
									<td>Status</td>
									<td>
									  @if($manualPayment->invoice->status == "pending") 
							           <span class="badge badge-warning">
							           	Pending
							           </span>
							          @elseif($manualPayment->invoice->status == "payment")
							           <span class="badge badge-success">
							           	Pembayaran
							           </span>
							          @elseif($manualPayment->invoice->status == "waiting")
							           <span class="badge badge-warning">
							           	Menunggu
							           </span>
							          @elseif($manualPayment->invoice->status == "running")
							           <span class="badge badge-warning">
							           	Berjalan
							           </span>
							          @elseif($manualPayment->invoice->status == "failed")
							           <span class="badge badge-danger">
							           	Digagalkan
							           </span>
							          @elseif($manualPayment->invoice->status == "canceled")
							           <span class="badge badge-danger">
							           	Dibatalkan
							           </span>
							          @elseif($manualPayment->invoice->status == "rejected")
							           <span class="badge badge-danger">
							           	Ditolak
							           </span>
							          @elseif($manualPayment->invoice->status == "compeleted")
							           <span class="badge badge-success">
							           	Selesai
							           </span>
							          @endif
									</td>
								</tr>					
								<tr>
									<td>Total</td>
									<td>
										Rp.{{number_format($manualPayment->invoice->total,2)}}
									</td>
								</tr>
								<tr>
									<td>Dibuat</td>
									<td>
										{{$manualPayment->invoice->get_human_created_at}}
									</td>
								</tr>
								<tr>
									<td colspan="2">
										@if($isValidasi)
											<div class="alert alert-info text-center">
												Untuk mengubah status invoice,
												pembayaran  harus tidak ada yang berstatus validsi
											</div>
										@else
											@if($manualPayment->invoice->status == "payment")
												<div class="text-center">
													<button class='btn btn-info'
														onclick="window.location='{{url('admin/manual-payment/completed/'.$manualPayment->invoice_id)}}'">
														<i class='fe fe-check'></i> Tuntaskan Pembayaran
													</button>
												</div>
											@endif
										@endif
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			@if(count($manualPayment->invoice->manual_payment))
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

								@foreach($manualPayment->invoice->manual_payment as $item)
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
@endsection

@section("sc_footer")
<script>
function failedPayment(action){
	swal.fire({
    	title: 'Apakah Anda Yakin?',
    	text: 'Mengagalkan pembayaran ini',
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