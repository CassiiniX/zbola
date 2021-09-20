@extends("user.layout.default")

@section("title")
Invoice
@endsection

@section("sc_header")
<style>
.font-size-30{
	font-size: 30px;
}
.font-size-8{
	font-size: 8px;
}
.font-size-15{
	font-size: 15px;
}
						
#box-tracker{
	border:0px solid gray;
	border-radius:20px;
	box-shadow:0px 3px 0px #eee;
}
</style>
@endsection

@section("content")
	<div class="container">
		@if($invoice)
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class='col-md-3 mb-3'>
						<img src="{{asset('assets/images/products/'.$invoice->product->get_images[0])}}" 
							class="img-fluid">
					</div>
					<div class="col-md-9 mb-3">
						<div class="row">
							<div class="col-12">
								<div class="clearfix">
									<div class="float-left">
										<h4>
											{{ucwords($invoice->product->address)}}
										</h4>
									</div>

									<div class="float-right">
										@if($invoice->status == "pending")	
										 <span class="badge badge-warning">
										 	Pending
										 </span>
										@elseif($invoice->status == "waiting")
										 <span class="badge badge-warning">
										 	Menunggu
										 </span>
										@elseif($invoice->status == "payment")
										 <span class="badge badge-success">
										 	Pembayaran
										 </span>
										@elseif($invoice->status == "running")
										 <span class="badge badge-warning">
										 	Berjalan
										 </span>
										@endif
									</div>
								</div>
							</div>

							<div class="col-12">
								<h5 class='text-success'>
									Rp.{{number_format($invoice->product->price,2)}} Perjam
								</h5>
							</div>
						
							<div class="col-12 mt-2">
								<b>
									Total : Rp.{{number_format($invoice->total,2)}} - ({{$invoice->hour}} Jam)
								</b>
							</div>

							<div class="col-12 mt-5">
								<div class="clearfix">									
									<div class="float-left text-left">
										<b>
											Tanggal Mulai : {{$invoice->start_rent}}
										</b>
									</div>
									<div class="float-right">
										<b>
											Dibuat Pada : {{$invoice->created_at}}
										</b>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		

		<div class="card">
			<div class="card-body">
				@if(!config('app.isMobile'))
				<div class="col-4 m-auto d-none d-md-block"
					id="tracker">
					<div class="row p-2" id="box-tracker">
						<div class="col-2 text-center">
							<div id="day-invoice" class="font-size-30"></div>
							<small>Hari</small>
						</div>
						<div class="col-1 font-size-30">
							:
						</div>
						<div class="col-2 text-center">			
							<div id="hour-invoice" class="font-size-30"></div>
							<small>Jam</small>
						</div>
						<div class="col-1 font-size-30">
							:
						</div>
						<div class="col-2 text-center">						
						 	<div id="minute-invoice" class="font-size-30"></div>
						 	<small>Menit</small>
						</div>
						<div class="col-1 font-size-30">
							:
						</div>
						<div class="col-2 text-center">
						 	<div id="second-invoice" class="font-size-30"></div>
						 	<small>Detik</small>
						</div>
					</div>

					<div class="col-12 text-center p-3">
						<b><span id="note-invoice"></span></b>
					</div>
				</div>
				@endif

				@if(config('app.isMobile'))
				<div class="col-12 m-auto d-block d-md-none" 
					id="tracker">
					<div class="row p-2" id="box-tracker">
						<div class="col-2 text-center">
							<div id="day-invoice" class="font-size-15"></div>
							<span class="font-size-8">Hari</span>
						</div>
						<div class="col-1" class="font-size-15">
							:
						</div>
						<div class="col-2 text-center">			
							<div id="hour-invoice" class="font-size-15"></div>
							<span class="font-size-8">Jam</span>
						</div>
						<div class="col-1" class="font-size-15">
							:
						</div>
						<div class="col-2 text-center">						
						 	<div id="minute-invoice" class="font-size-15"></div>
							<span class="font-size-8">Menit</span>
						</div>
						<div class="col-1" class="font-size-15">
							:
						</div>
						<div class="col-2 text-center">
						 	<div id="second-invoice" class="font-size-15"></div>
							<span class="font-size-8">Detik</span>
						</div>
					</div>

					<div class="col-12 text-center p-3">
						<b><span id="note-invoice"></span></b>
					</div>
				</div>
				@endif

				<div class="mt-5 mb-5"></div>

				<div class="col-md-5 m-auto text-center">
					<button class="btn btn-danger mb-2"
						onclick="cancelOrder('{{url('user/invoice/cancel')}}')">
						<i class='fe fe-x'></i> Batalkan
					</button>

					@if($invoice->status == "payment")
						<button class="btn btn-success mb-2"
							data-toggle="modal" data-target="#modal-payment-box">
							<i class='fe fe-dollar-sign'></i> 
							Lakukan Pembayaran
						</button>
						<button class="btn btn-primary mb-2"
							data-toggle="modal" data-target="#modal-account">
							<i class='fe fe-info'></i> 
							Info Rekening
						</button>
					@endif

					@if($invoice->status == "running")
						<button class="btn btn-success mb-2"
							data-toggle="modal" data-target="#modal-review">
							<i class='fe fe-message-circle'></i> 
							Review Lapangan
						</button>
					@endif
				</div>
			</div>
		</div>

		@include("user.invoice.payment")

		@include("user.invoice.running")

		@endif
		
		@if(!($invoice))
		<div class="card">
			<div class="card-body">
				<div class="col-md-8 m-auto text-center">
					<img src="{{asset('assets/images/invoice-404.png')}}"
						class="img-fluid">
					<h5>Data invoice tidak ditemukan</h5>
				</div>
			</div>
		</div>
		@endif
	</div>
@endSection

@section("sc_footer")
<script>
function cancelOrder(action){
	swal.fire({
    	title: 'Apakah Anda Yakin?',
    	text: 'Membatalkan Pesanan Ini',
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

@if($invoice)
<script>
	var theTracking = {
		timeTracking : {
			theTime :  null,
			active : null,
		}
	};

	function startTracking(){  
	  if("{{$invoice->status}}" == 'pending'){
	    var tommorow = moment("{{$expiredPayment}}").format('YYYY-MM-DD HH:mm:ss'); 
	    $("#note-invoice").html("* Note : Menunggu divalidasi admin");
	  }

	  if("{{$invoice->status}}" == 'payment'){
	    var tommorow = moment("{{$expiredPayment}}").format('YYYY-MM-DD HH:mm:ss');   
	    $("#note-invoice").html("* Note : Menunggu pembayaran dari user");    
	  }

	  if("{{$invoice->status}}" == 'waiting'){
	    var tommorow = moment("{{$invoice->start_rent}}").format('YYYY-MM-DD HH:mm:ss');   
	    $("#note-invoice").html("* Note : Menunggu hari H");  
	  }

	  if("{{$invoice->status}}" == 'running'){
	    var tommorow = moment("{{$endRent}}").format('YYYY-MM-DD HH:mm:ss');   
	    $("#note-invoice").html("* Note : Dalam Penyewaan");        
	  }  

	  theTracking.timeTracking.theTime = new Date(tommorow).getTime();      

	  theTracking.timeTracking.active = setInterval(() => {
	    var now = new Date().getTime();
	    var timeleft = theTracking.timeTracking.theTime - now;

	    var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
	    var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	    var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
	    var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);          

	    $("#day-invoice").html(days);
	    $("#hour-invoice").html(hours);
	    $("#minute-invoice").html(minutes);
	    $("#second-invoice").html(seconds);

	   if (timeleft < 0) {
	    clearTracking();
	   }
	  },1000);
	}

	function clearTracking(){
		clearInterval(theTracking.timeTracking.active);

		if("{{$invoice->status}}" == 'pending'){
	    	$("#note-invoice").html("* Note : Admin tidak memvalidasi invoice ini");
	  	}

	  	if("{{$invoice->status}}" == 'payment'){
	  	  $("#note-invoice").html("* Note : Anda telat membayar invoice ini");    
	  	}

	  	if("{{$invoice->status}}" == 'waiting'){
	  	  $("#note-invoice").html("* Note : Waktu penyewaan telah dimulai");  
	  	}

	  	if("{{$invoice->status}}" == 'running'){
	    	$("#note-invoice").html("* Note : Waktu penyewaan telah selesai");        
	  	}  

	 	$("#day-invoice").html("0");
	    $("#hour-invoice").html("0");
	    $("#minute-invoice").html("0");
	    $("#second-invoice").html("0");

	    $("#tracker").addClass("text-danger");
	}

	startTracking();
</script>
@endif
@endSection