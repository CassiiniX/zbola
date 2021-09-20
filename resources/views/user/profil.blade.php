@extends("user.layout.default")

@section("title")
Profil
@endsection

@section("content")
<div class="container">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6 text-center mb-3">
					<div class="col-10 text-center m-auto">
						<img src="{{asset('assets/images/users/'.auth()->user()->photo)}}"
							class="img-fluid">
					</div>

					<form method="post" action="{{route('user.edit.photo')}}" class="mt-4" enctype="multipart/form-data">
						{{csrf_field()}}
						
						<div class="row">
							<div class="col-md-8 mb-2">
								<input type="file" class="form-control" name="photo">
							</div>
							<div class="col-md-3 mb-2">								
								<button class="btn btn-success">
									<i class='fe fe-send'></i> Kirim
								</button>
							</div>
						</div>
					</form>
				</div>

				<div class="col-md-6 mb-3">
					<h5>Update Data</h5>

					<form class="mt-4" method="post" action="{{route('user.edit.data')}}" id="form-data">
			            {{ csrf_field() }}

			            <div class="form-group">
			              <div class="mt-2">Email</div>
			              <div class="mt-2">
			                  <input type="email" class="form-control" placeholder="Email . . ." name="email"
			                    data-parsley-required
			                    value="{{old('email',auth()->user()->email)}}">
			                  <small class="text-muted">Masukan Email</small>
			              </div>              
			            </div>

			            <div class="form-group">
			              <div class="mt-2">No Telp</div>
			              <div class="mt-2">
			                <input type="text" class="form-control" placeholder="No Telp . . ." name="phone"
			                  data-parsley-required
			                  value="{{old('phone',auth()->user()->phone)}}">
			                <small class="text-muted">Masukan No Telp (*harus 08)</small>
			              </div>
			            </div>

			            <div class="form-group">
			              <div class="mt-2">Password</div>
			              <div class="mt-2">
			                <input type="password" class="form-control" placeholder="Password . . ." name="password"
			                value="{{old('password','')}}">
			                <small class="text-muted">Masukan Password</small>
			              </div>
			            </div>

			            <div class="form-group">
			              <div class="mt-2">Password Confirm</div>
			              <div class="mt-2">
			                <input type="password" class="form-control" placeholder="Password Konfirmasi . . ." name="password_confirm"
			                 value="{{old('password_confirm','')}}"
			                 data-parsley-required>
			                <small class="text-muted">Masukan Password Konfirmasi</small>
			              </div>
			            </div>			          

			            <div class="form-group">
			              <button class="btn btn-success">
			              	<i class='fe fe-send'></i> Kirim
			              </button>
			            </div>			           
			         </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endSection

@section("sc_footer")
<script>
$("#form-data").parsley().on('form:validate',function(){
  if(this.isValid()){
    $(".btn-success").attr("disabled",true);
  }else{
    toastr.warning("Sepertinya ada data yang belum valid","");
  }  
});
</script>
@endSection