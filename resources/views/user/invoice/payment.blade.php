@if($invoice->status == "payment")
<div id="modal-payment-box" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border:0px solid red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div> 

      <div class="modal-body">      
			<img src="{{asset('assets/images/modal-box-payment.png')}}" class="img-fluid">

			<form class="mt-4" method="post" enctype="multipart/form-data" action="{{url('user/payment')}}">
				{{csrf_field()}}				
        
				<div class="form-group">
					<div class="small text-muted">
            Keterangan : 
          </div>
					<div><textarea placeholder="Keterangan" class="form-control" name="description"></textarea></div>
				</div>
				<div class="form-group">
					<div class="small text-muted">
            Bukti : 
          </div>
					<div><input type="file" class="form-control" name="proof"></div>
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

<div id="modal-account" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border:0px solid red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div> 

      <div class="modal-body">      
      	<div class="table-responsive">
      		<table class="table table-borderless">
      			<tr class="bg-primary">
      				<th colspan="2" class="text-white">Bank Bri</th>      				
      				<th colspan="2" class="text-white">Bank Bni</th>      				
      			</tr>
      			<tr>
      				<td>No Rekening : </td>      				
      				<td>12345678</td>
      				<td>No Rekening :</td>
      				<td>1234567</td>
      			</tr>
      			<tr>
      				<td>Atas Nama :</td>
      				<td>User</td>
      				<td>Atas Nama :</td>
      				<td>User1</td>
      			</tr>      		
      		</table>
      	</div>
      </div>		      
    </div>
  </div>
</div>
@endif