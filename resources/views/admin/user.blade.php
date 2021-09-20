@extends("admin.layout.default")

@section("title")
User
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Kelola User</h3>
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
  			<th>Photo</th>
  			<th>Username</th>
  			<th>Email</th>
  			<th>Phone</th>
  			<th>Role</th>
  			<th>Dibuat</th>
  			<th>Opsi</th>
  		</tr>

  		@foreach($user as $item)
  		<tr>
  			<td>{{$item->id}}</td>
  			<td class="p-0 text-center">
  				<a href="{{asset('assets/images/users/'.$item->photo)}}" target="_blank">
  					<img src="{{asset('assets/images/users/'.$item->photo)}}"
  					width="100px"/>  			
  				</a>
  			</td>
  			<td>{{$item->username}}</td>
  			<td>{{$item->email}}</td>
  			<td>{{$item->phone}}</td>
  			<td>
  				@if($item->role == 'user')
  					<span class='badge badge-success'>User</span>
  				@else
  					<span class='badge badge-danger'>Admin</span>
  				@endif
  			</td>
  			<td>
  				{{$item->get_human_created_at}}
  			</td>
  			<td>
  				<button class="btn btn-success" 
  					data-toggle="modal" data-target="#modal-edit-user{{$item->id}}">
  					<i class='fe fe-edit'></i> Edit
  				</button>
  			</td>
  		</tr>

  		<div id="modal-edit-user{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog modal-md" role="document">
		    <div class="modal-content">
		      <div class="modal-header" style="border:0px solid red">
		      	<h5>Edit User</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
		      </div> 

		      <div class="modal-body">      
				<form method="post" action="{{url('admin/user/edit/'.$item->id)}}">
					{{csrf_field()}}				

					<div class="form-group">
						<div class="small text-muted mb-2">Email : </div>
						<div>
							<input type="text" class="form-control" name="email" placeholder="Email . . ." value="{{$item->email}}">
						</div>
					</div>

					<div class="form-group">
						<div class="small text-muted mb-2">Phone : </div>
						<div>
							<input type="text" class="form-control" name="phone" placeholder="Phone . . ." value="{{$item->phone}}">
						</div>
					</div>

					<div class="form-group">
						<div class="small text-muted mb-2">Role : </div>
						<div>
							<select class="form-control" name="role">
								<option value="admin" {{$item->role == 'admin' ? 'selected' : ''}}>Admin</option>
								<option value="user" {{$item->role == 'user' ? 'selected' : ''}}>User</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<div class="small text-muted mb-2">Password : </div>
						<div>
							<input type="password" class="form-control" placeholder="Masukan password jika ingin menganti . . .">
						</div>
					</div>

					<div class="form-group">
						<button class="btn btn-success btn-block">
							<i class='fe fe-send'></i> Kirim
						</button>
					</div>
				</form>
		      </div>		      
		    </div>
		  </div>
		</div>
  		@endforeach

  		@if(!count($user))
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
  		{{$user->links()}}
  	</div>
  </div>
</div>
@endSection