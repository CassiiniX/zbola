@extends("user.layout.default")

@section("title")
Pemesanan
@endsection

@section("sc_header")
<style>
.font-size-30{
 	font-size:30px
}
.font-size-20{
	font-size: 20px;
}
.font-size-25{
	font-size: 25px;
}
</style>
@endsection

@section("content")
	<div class="container">
		<div class="row">
			<div class="col-md-9 bg-white">
				<div class="row">
					<div class="col-md-6 bg-white p-3">
						<img src="{{asset('assets/images/products/'.$product->get_images[0])}}"
							class="img-fluid">

						@foreach($product->get_images as $item)
							<img src="{{asset('assets/images/products/'.$item)}}"
								width="100px" class="mt-3 ml-3" onclick="window.location='{{asset('assets/images/products/'.$item)}}'">
						@endforeach
					</div>

					<div class="col-md-6 bg-white p-3">
						<div class="font-size-30">
							{{ucwords($product->address)}}
						</div>

						<div class="text-success mt-2 font-size-20">
							Rp.{{number_format($product->price,2)}} Perjam
						</div>

						<div class="row mt-3">
							<div class="p-4 text-center col-4">
								<i class='fe fe-star font-size-25'></i> 
								<br/>
								Bintang
								<br/>
								{!!$product->get_star!!}			
							</div>				
							<div class="p-4 text-center col-4">
								<i class='fe fe-sun font-size-25'></i> 
								<br/>Status<br/>
								@if($product->rent)
									<span class="text-danger">
										Tersewa
									</span>
								@else
									<span class="text-success">
										Tidak Tersewa
									</span>
								@endif
							</div>
							<div class="p-4 text-center col-4">
								<i class='fe fe-calendar font-size-25'></i>
								<br/>
								Dipublish Pada
								<br/>
								<span class='text-success'>
									{{$product->get_human_created_at}}
								</span>
							</div>
						</div>				
					</div>
				</div>	
			</div>

			<div class="col-md-3 bg-white p-4">
				<form method="post" action="{{url('user/order')}}">
					{{csrf_field()}}

					<input type="hidden" name="product" value="{{$product->id}}">

					<div class="mb-4">
						<h5>Tanggal Mulai</h5>
						<input type="date" min="{{$minDate ?? ''}}" class="form-control" name="date_start" required>
					</div>

					<div class="mb-4">
						<h5>Jam Mulai</h5>
						<select class="form-control" name="hour_start">
							<option value="8">Jam 8 pagi</option>
							<option value="9">Jam 9 Pagi</option>
							<option value="10">Jam 10 Pagi</option>
							<option value="11">Jam 11 Siang</option>
							<option value="12">Jam 12 Siang</option>
							<option value="13">Jam 1 Siang</option>
							<option value="14">Jam 2 Siang</option>
							<option value="15">Jam 3 Sore</option>
						</select>
					</div>

					<div class="mb-4">
						<h5>Berapa Jam</h5>
						<select class="form-control" onchange="changeHour(event)" name="hours">
							@foreach(range(1,$hours) as $item)
								<option value="{{$item}}">
									{{$item}}
								</option>
							@endforeach
						</select>					
					</div>

					<div class="mb-4">
						<h5>Total</h5>
						<input type="text" class="form-control" placeholder="Total . . ." name="total" readonly>
					</div>

					<div class="mb-4">
						<button class="btn btn-success">
							<i class='fe fe-send'></i>
							Order Sekarang
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endSection

@section("sc_footer")
<script>
function changeHour(){
 var price = "{{$product->price}}";
 var realPrice = price * $("select[name=hours]").val();
 $("input[name=total]").val(realPrice.toLocaleString('id-ID',{
 	style : 'currency',
 	currency : 'IDR'
 })); 
}
changeHour();
</script>
@endSection