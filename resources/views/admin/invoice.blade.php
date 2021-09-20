@extends("admin.layout.default")

@section("title")
  Inovice
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Kelola Invoice</h3>
		</div>

		<div class="float-right">
			<form>
				<input type="text" class="form-control" placeholder="Search . . ." value="{{$search}}"
					name="search"
					onkeyup="event.key == 13 ? this.form.submit() : ''">
			</form>
		</div>
	</div>

  <div class="table-responsive bg-white p-3">
  	<table class="table">
  		<tr>
  			<th>Id</th>
  			<th>Product</th>
  			<th>Username</th>
  			<th>Status</th>
  			<th>Awal Rental</th>  	
        <th>Jam</th>
        <th>Total</th>
  			<th>Dibuat</th>
  			<th>Opsi</th>
  		</tr>

  		@foreach($invoice as $item)
  		<tr>
  			<td>{{$item->id}}</td>  			
        <td>
          <a href="{{url('admin/product?search='.$item->product->address)}}" target="_blank">
            {{$item->product->address}}
          </a>
        </td>
        <td>
          <a href="{{url('admin/user?search='.$item->user->username)}}" target="_blank">
            {{$item->user->username}}
          </a>
        </td>
        <td>
          @if($item->status == "pending") 
           <span class="badge badge-warning">
            Pending
          </span>
          @elseif($item->status == "payment")
           <span class="badge badge-success">
            Pembayaran
          </span>
          @elseif($item->status == "waiting")
           <span class="badge badge-warning">
            Menunggu
          </span>
          @elseif($item->status == "running")
           <span class="badge badge-warning">
            Berjalan
          </span>
          @elseif($item->status == "failed")
           <span class="badge badge-danger">
            Digagalkan
          </span>
          @elseif($item->status == "canceled")
           <span class="badge badge-danger">
            Dibatalkan
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
        </td>
        <td>
          {{$item->start_rent}}
        </td>
        <td>
          {{$item->hour}} Jam
        </td> 
        <td>
          Rp.{{number_format($item->total,2)}}
        </td>
        <td>
          {{$item->get_human_created_at}}
        </td>
        <td>
          <button class="btn btn-primary"
            onclick="window.location='{{url('admin/invoice/detail/'.$item->id)}}'">
            <i class='fe fe-info'></i> 
            Detail
          </button>
        </td>
  		</tr>  		
  		@endforeach

  		@if(!count($invoice))
  		<tr>
  			<td colspan="10">
          <div class="col-4 m-auto text-center p-4">
            <img src="{{asset('assets/images/404.png')}}"
              class="img-fluid">
  				  <h5>Data tidak ditemukan</h5>
          </div>
  			</td>
  		</tr>
  		@endif
  	</table>

  	<div class="p-3">
  		{{$invoice->links()}}
  	</div>
  </div>
</div>
@endSection