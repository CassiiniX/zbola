@extends("user.layout.default")

@section("title")
	Detail Lapangan
@endsection

@section("sc_header")
<style>
.cursor-pointer{
	cursor:pointer
}
.description{
	background:#eee
}
.font-size-30{
	font-size: 30px;
}
.font-size-25{
	font-size: 25px;
}
.font-size-20{
	font-size: 20px;
}
.other-image{
	height:50px;
	cursor:pointer;
}
</style>
@endsection

@section("content")
	<div class="container">
		<div class="row">
			<div class="col-md-6 bg-white p-3">
				<img src="{{asset('assets/images/products/'.$product->get_images[0])}}"
					class="img-fluid">			

				<div class="d-flex flex-row">
					@foreach($product->get_images as $item)
						<img src="{{asset('assets/images/products/'.$item)}}"
							class="mt-2 ml-2 other-image" onclick="window.location='{{asset('assets/images/products/'.$item)}}'">		
					@endforeach
				</div>				
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
						<br/>Bintang<br/>
						{!! $product->get_star !!}			
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
						<br/>Dipublish Pada<br/>
						<span class='text-success'>
							{{$product->get_human_created_at}}
						</span>
					</div>
				</div>

				<div class="mt-4">
					<button class="btn btn-success"
						onclick="window.location='{{url('user/order/'.$product->id)}}'">
						<i class='fe fe-send'></i> 
						Masukan Ke Invoice
					</button>
				</div>
			</div>

			<div class="col-12 mt-4 bg-white">
				<div class="row p-3">
					<div class="col-md-1 col-3 cursor-pointer" 
						onclick="showProductData('#product-description')">
						Deskripsi
					</div>
					<div class="col-md-1 col-3 cursor-pointer"
						onclick="showProductData('#product-fasilitas')">
						Fasilitas
					</div>
					<div class="col-md-1 col-3 cursor-pointer"
						onclick="showProductData('#product-quesation')">
						Pertanyaan
					</div>
					<div class="col-md-1 col-3 cursor-pointer"
						onclick="showProductData('#product-review')">
						Review
					</div>
				</div>

				<div id="product-description" class="product-data p-3">
					{{$product->description}}
				</div>

				<div id="product-fasilitas" class="product-data p-3">
					{{$product->fasilitas}}
				</div>

				<div id="product-quesation" class="product-data p-3">
					{{$product->quesation}}
				</div>

				<div id="product-review" class="product-data p-3">
					@if(!count($product->reviews))
						<div class="col-md-5 text-center m-auto">
							<img src="{{asset('assets/images/404.png')}}" 
								class="img-fluid">								
							<h5>Data review tidak ditemukan</h5>							
						</div>
					@endif

					@foreach($product->reviews as $item)
						<div class="row mt-5">
							<div class="col-md-1 col-3">
								<img src="{{asset('assets/images/users/'.$item->user->photo)}}" 
									class="img-fluid">
							</div>
							<div class="col-md-11 col-9">
								<div class="row">
									<div class="col-12">
										<div class="clearfix">
											<div class="float-left">
												{{$item->user->username}} | {!! $item->get_star !!}
											</div>
											<div class="float-right">
												{{$item->get_human_created_at}}
											</div>
										</div>								
									</div>
									<div class="col-12 p-4 mt-3 description">
										{{$item->description}}
									</div>
								</div>
							</div>
						</div>
					@endforeach				
				</div>
			</div>
		</div>
	</div>
@endSection

@section("sc_footer")
<script>
$(".product-data").hide();

function showProductData(id){
	$(".product-data").hide();
	$(id).show();
}
</script>
@endSection