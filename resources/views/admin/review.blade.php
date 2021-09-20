@extends("admin.layout.default")

@section("title")
Review
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Kelola Review</h3>
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
  			<th>Bintang</th>
  			<th>Komentar</th>  	
  			<th>Dibuat</th>
  			<th>Opsi</th>
  		</tr>

  		@foreach($review as $item)
  		<tr>
  			<td>{{$item->id}}</td>
  			<td>
  				<a href="{{url('admin/product?search='.$item->product->id)}}" target="_blank">
  					{{$item->product->address}}
  				</a>
  			</td>
  			<td>
  				<a href="{{url('admin/user?search='.$item->user->username)}}" target="_blank">
  					{{$item->user->username}}
  				</a>
  			</td>
  			<td>{!!$item->get_star!!}</td>
  			<td>{{$item->description}}</td>  			
  			<td>{{$item->get_human_created_at}}</td>
  			<td>
  				<button class="btn btn-danger"
  					onclick="removeData('{{url('admin/review/delete/'.$item->id)}}')">
  					<i class='fe fe-trash'></i> 
            Hapus
  				</button>
  			</td>
  		</tr>  		
  		@endforeach

  		@if(!count($review))
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
  		{{$review->links()}}
  	</div>
  </div>
</div>
@endSection

@section("sc_footer")
<script>
function removeData(action){
	swal.fire({
    	title: 'Apakah Anda Yakin?',
    	text: 'Menghapus data ini',
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