@extends("admin.layout.default")

@section("title")
Lapangan
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Kelola Product</h3>
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
    <div class="mt-3 mb-3">
      <button class="btn btn-primary"
        data-toggle="modal" data-target="#modal-add">
        <i class='fe fe-plus'></i> 
        Tambah
      </button>
    </div>

  	<table class="table">
  		<tr>
  			<th>Id</th>
        <th class="text-center">Gambar</th>
  			<th>Alamat</th>
  			<th>Bintang</th>
  			<th>Harga</th>
        <th>Rental</th>
        <th>Status</th>
  			<th>Dibuat</th>
  			<th>Opsi</th>
  		</tr>

  		@foreach($product as $item)
  		<tr>
  			<td>{{$item->id}}</td>
  			<td class="p-0 text-center"> 
          <a href="{{asset('assets/images/products/'.$item->get_images[0])}}" target="_blank">
            <img src="{{asset('assets/images/products/'.$item->get_images[0])}}" width="100px" />
          </a>
        </td>
  			<td>{{$item->address}}</td>
  			<td>{!! $item->get_star !!}</td>
  			<td>Rp.{{number_format($item->price,2)}}</td>  			
        <td>
          @if($item->rent)
            <span class="badge badge-danger">
              Tersewa
            </span>
          @else
            <span class="badge badge-success">
              Belum Tersewa
            </span>
          @endif
        </td>
        <td>
          @if($item->status == "active")
            <span class="badge badge-success">
              Aktif
            </span>
          @else
            <span class="badge badge-danger">
              Nonaktif
            </span>
          @endif
        </td>
  			<td>{{$item->get_human_created_at}}</td>
  			<td>
          <button class="btn btn-success"
            data-toggle="modal" data-target="#modal-edit-{{$item->id}}">
            <i class='fe fe-edit'></i> 
            Edit
          </button>
  			</td>
  		</tr>  		

      <div id="modal-edit-{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header" style="border:0px solid red">
              <h5>Edit Product {{$item->id}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div> 

            <div class="modal-body">      
              <form method="post" action="{{url('admin/product/edit/'.$item->id)}}" enctype="multipart/form-data">

                {{csrf_field()}}        

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Alamat : 
                  </div>
                  <div>
                    <textarea class="form-control" placeholder="Alamat . . ." name="address">{{$item->address}}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Harga : 
                  </div>
                  <div>
                    <input type="text" class="form-control" placeholder="Harga . . ." name="price"  value="{{$item->price}}">
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Status : 
                  </div>
                  <div>
                    <select class="form-control" name="status">
                      <option value="active" {{$item->status == 'active' ? 'selected' : ''}}>
                        Aktif
                      </option>
                      <option value="nonactive" {{$item->staus == "nonactive" ? 'selected' : ''}}>
                        Nonaktif
                      </option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Deskripsi : 
                  </div>
                  <div>
                    <textarea id="summernote-edit-{{$item->id}}-description" class="form-control" name="description"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Fasilitas : 
                  </div>
                  <div>
                    <textarea id="summernote-edit-{{$item->id}}-fasilitas" class="form-control" name="fasilitas"></textarea>
                  </div>
                </div>  

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Quesation : 
                  </div>
                  <div>
                    <textarea id="summernote-edit-{{$item->id}}-quesation" class="form-control" name="quesation"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Gambar 1 : 
                  </div>
                  <div>
                    <input type="file" class="form-control" name="image1">
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Gambar 2 : 
                  </div>
                  <div>
                      <input type="file" class="form-control" name="image2">
                  </div>
                </div>
        
                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Gambar 3 : 
                  </div>
                  <div>
                    <input type="file" class="form-control" name="image3">
                  </div>
                </div>

                <div class="form-group">
                  <button class="btn btn-success btn-block">
                    <i class='fe fe-send'></i> 
                    Kirim
                  </button>
                </div>
              </form>
            </div>          
          </div>
        </div>
      </div>
  		@endforeach

  		@if(!count($product))
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
  		{{$product->links()}}
  	</div>
  </div>
</div>
@endSection

@section("sc_footer")
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border:0px solid red">
        <h5>Tambah Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div> 

      <div class="modal-body">      
        <form method="post" action="{{url('admin/product/add')}}" enctype="multipart/form-data">

          {{csrf_field()}}        

          <div class="form-group">
            <div class="mb-2 text-muted">
              Alamat : 
            </div>
            <div>
              <textarea class="form-control" placeholder="Alamat . . ." name="address"></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Harga : 
            </div>
            <div>
              <input type="text" class="form-control" placeholder="Harga . . ." name="price" >
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Status : 
            </div>
            <div>
              <select class="form-control" name="status">
                <option value="active">
                  Aktif
                </option>
                <option value="nonactive">
                  Nonaktif
                </option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Deskripsi : 
            </div>
            <div>
              <textarea id="summernote-add-description" class="form-control" name="description"></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Fasilitas : 
            </div>
            <div>
              <textarea id="summernote-add-fasilitas" class="form-control" name="fasilitas"></textarea>
            </div>
          </div>  

          <div class="form-group">
            <div class="mb-2 text-muted">
              Quesation : 
            </div>
            <div>
              <textarea id="summernote-add-quesation" class="form-control" name="quesation"></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Gambar 1 : 
            </div>
            <div>
              <input type="file" class="form-control" name="image1">
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Gambar 2 : 
            </div>
            <div>
                <input type="file" class="form-control" name="image2">
            </div>
          </div>
  
          <div class="form-group">
            <div class="mb-2 text-muted">
              Gambar 3 : 
            </div>
            <div>
              <input type="file" class="form-control" name="image3">
            </div>
          </div>

          <div class="form-group">
            <button class="btn btn-success btn-block">
              <i class='fe fe-send'></i> 
              Kirim
            </button>
          </div>
        </form>
      </div>          
    </div>
  </div>
</div>

<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script>
$('#summernote-add-quesation').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-add-quesation").summernote("code","<p>Pertanyaan</p>");

$('#summernote-add-description').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-add-description").summernote("code","<p>Deskripsi</p>");

$('#summernote-add-fasilitas').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-add-fasilitas").summernote("code","<p>Fasilitas</p>");
</script>

@foreach($product as $item)
<script>
$('#summernote-edit-{{$item->id}}-quesation').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-edit-{{$item->id}}-quesation").summernote("code","{!! $item->quesation !!}");

$('#summernote-edit-{{$item->id}}-description').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-edit-{{$item->id}}-description").summernote("code","{!! $item->description !!}");

$('#summernote-edit-{{$item->id}}-fasilitas').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-edit-{{$item->id}}-fasilitas").summernote("code","{!! $item->fasilitas !!}");
</script>
@endforeach
@endSection