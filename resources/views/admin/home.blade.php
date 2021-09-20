@extends("admin.layout.default")

@section("title")
	Home
@endsection

@section("sc_header")
<style>
#chartContainer{
	height: 370px; 
	max-width: 920px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="page-header">
	  <h1 class="page-title">
	    Dashboard
	  </h1>
	</div>

	<div class="row row-cards">
	  <div class="col-sm-6 col-lg-3">
	    <div class="card p-3">
	      <div class="d-flex align-items-center">
	        <span class="stamp stamp-md bg-blue mr-3">
	          <i class="fe fe-users"></i>
	        </span>
	        <div>
	          <h4 class="m-0">
	          	<a href="{{url('admin/user')}}">
		         {{$user['total_user']}} 
	          	 <small>User</small>
	          	</a>
	          </h4>
	          <small class="text-muted">
	          	{{$user['total_admin']}} 
	          	Admin
	          </small>
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-lg-3">
	    <div class="card p-3">
	      <div class="d-flex align-items-center">
	        <span class="stamp stamp-md bg-green mr-3">
	          <i class="fe fe-clipboard"></i>
	        </span>
	        <div>
	          <h4 class="m-0">
	          	<a href="{{url('admin/invoice')}}">
	          		{{$invoice['total_invoice']}} 
	          		<small>Invoice</small>
	          	</a>
	          </h4>
	          <small class="text-muted">
	          	{{$invoice['total_invoice_pending']}} 
	          	Pending
	          </small>
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-lg-3">
	    <div class="card p-3">
	      <div class="d-flex align-items-center">
	        <span class="stamp stamp-md bg-red mr-3">
	          <i class="fe fe-list"></i>
	        </span>
	        <div>
	          <h4 class="m-0">
	          	<a href="{{url('admin/product')}}">
	          		{{$product['total_product']}} 
	          		<small>Lapangan</small>
	          	</a>
	          </h4>
	          <small class="text-muted">
	          	{{$product['total_product_nonactive']}} 
	          	Nonaktif
	          </small>
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-lg-3">
	    <div class="card p-3">
	      <div class="d-flex align-items-center">
	        <span class="stamp stamp-md bg-yellow mr-3">
	          <i class="fe fe-dollar-sign"></i>
	        </span>
	        <div>
	          <h4 class="m-0">
	          	<a href="{{url('admin/manual-payment')}}">
	          		{{$payment['total_payment']}} 
	          		<small>Pembayaran</small>
	          	</a>
	          </h4>
	          <small class="text-muted">
	          	{{$payment['total_payment_validasi']}} 
	          	Validasi
	          </small>
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-lg-3">
	    <div class="card">
	      <div class="card-body p-3 text-center">
	      	<div class="h1 m-0">
	      		{{$user['total_new_user']}}
	      	</div>
	        <div class="text-muted mb-4">
	        	User Baru
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-lg-3">
	    <div class="card">
	      <div class="card-body p-3 text-center">	        
	        <div class="h1 m-0">
	        	{{$review['total_new_review']}}
	        </div>
	        <div class="text-muted mb-4">
	        	Review Baru
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-lg-3">
	    <div class="card">
	      <div class="card-body p-3 text-center">	     
	        <div class="h1 m-0">
	        	{{$invoice['total_new_invoice']}}
	        </div>
	        <div class="text-muted mb-4">
	        	Invoice Baru
	        </div>
	      </div>
	    </div>
	  </div>
	  <div class="col-sm-6 col-lg-3">
	    <div class="card">
	      <div class="card-body p-3 text-center">	     
	        <div class="h1 m-0">
	        	{{$payment['total_new_payment']}}
	        </div>
	        <div class="text-muted mb-4">
	        	Pembayaran Baru
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="col-lg-8">
	    <div class="card">
	      <div class="card-header">
	        <h3 class="card-title">
	        	Sewa selesai 10 hari terakhir
	        </h3>
	      </div>
	      <div class="card-body">
	      	<div id="chartContainer">
           	</div>
           </div>
	    </div>	             
	  </div>

	  <div class="col-md-4">
	    <div class="table-responsive bg-white">
	        <table class="table card-table table-striped table-vcenter">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Gambar</th>
	              <th>Username</th>	             
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach($user['new_user'] as $item)
	           	<tr>
	           	  <td>{{$item->id}}</td>
	           	  <td>
	           	  	<img src="{{asset('assets/images/users/'.$item->photo)}}" 
	           	  		style="width:50px">
	           	  </td>
	           	  <td>{{$item->username}}</td>
	           	 </tr>
	           	@endforeach

	           	@if(!count($user['new_user']))
	           	<tr>
	           		<td colspan="3" class="text-center">
	           			Data tidak ditemukan
	           		</td>
	           	</tr>
	           	@endif
	          </tbody>
	        </table>
	      </div>
	  </div>            	  
	</div>            
</div>         
@endSection

@section("sc_footer")
<script src="{{ asset('assets/js/canvasjs.min.js') }}"></script>

<script>
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    horizontalAlign: "left"
  },
  data: [{
    type: "column",
    // line
    // pie
    // doughnut
    // column
    startAngle: 60,
    indexLabelFontSize: 17,
    indexLabel: "{label}",
    toolTipContent: "{y}",
    dataPoints: [
      @foreach($chart as $item)
	      { y: {{$item['y']}}, label: "{{$item['label']}}" },     
      @endforeach
    ]
  }]
});

chart.render();
</script>
@endSection