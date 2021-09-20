@extends("admin.layout.default")

@section("title")
Pembayaran Manual
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Kelola Pembayaran Manual</h3>
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
        <th class="text-center">Bukti</th>
  			<th>Invoice</th>
  			<th>Username</th>
  			<th>Deskripsi</th>  			
        <th>Status</th>
  			<th>Dibuat</th>
  			<th>Opsi</th>
  		</tr>

  		@foreach($manualPayment as $item)
  		<tr>
  			<td>{{$item->id}}</td>  			
        <td class="text-center">
          <a href="{{asset('assets/images/proofs/'.$item->proof)}}" target="_blank">
            <img src="{{asset('assets/images/proofs/'.$item->proof)}}" 
              width="100px"/>
          </a>
        </td>
        <td>
          <a href="{{url('admin/invoice?search='.$item->invoice_id)}}" target="_blank">
            {{$item->invoice_id}}
          </a>
        </td>
        <td>
          <a href="{{url('admin/user?search='.$item->user->username)}}" target="_blank">
            {{$item->user->username}}
          </a>
        </td>
        <td>
          {{ $item->description }}
        </td>     
        <td>
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
        </td>
        <td>
          {{$item->get_human_created_at}}
        </td>
        <td>
          <button class="btn btn-primary"
            onclick="window.location='{{url('admin/manual-payment/detail/'.$item->id)}}'">
            <i class='fe fe-info'></i> 
            Detail
          </button>
        </td>
  		</tr>  		
  		@endforeach

  		@if(!count($manualPayment))
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
  		{{$manualPayment->links()}}
  	</div>
  </div>
</div>
@endSection