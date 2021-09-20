@extends("user.layout.default")

@section("title")
Lapangan
@endsection

@section("sc_header")
<style>
.cursor-pointer{
	cursor:pointer;
}

.img-product{
	height:150px;
	object-fit:cover;
}

.pagination-wareper{
	max-width:350px;
	overflow-x:auto
}
</style>
@endsection

@section("content")
	<div class="container">
		<div class="row">	
        	@foreach($product as $item)
				<div class="col-md-3">
					<div class="card">
						<img class="card-img-top cursor-pointer img-product" 
							src="{{ asset('assets/images/products/'.json_decode($item->images)[0]) }}"
							onclick="window.location='{{url('user/product/'.$item->id)}}'">

						<div class="card-body">
							<div class="clearfix mb-1">
								<div class="float-left cursor-pointer" 
									onclick="window.location='{{url('user/product/'.$item->id)}}'">
									{{ucwords($item->address)}}
								</div>
								<div class="float-right">
									{!!$item->get_star!!}
								</div>
							</div>

							<div class="mb-1">
								Rp.{{number_format($item->price,2)}}
							</div>

							<div class="text-danger mb-3">
								@if($item->rent)
								 <span class="text-danger">Tersewa</span>
								@else
								 <span class="text-success">Tidak Tersewa</span>
								@endif
							</div>

							<div class="text-center">
								<button class="btn btn-success"
									onclick="window.location='{{url('user/order/'.$item->id)}}'">
									Masukan ke invoice
								</button>
							</div>
						</div>
					</div>
				</div>
        	@endforeach

        	<div class="pagination-wareper">
        		{{$product->links()}}
        	</div>
		</div>
	</div>
@endSection