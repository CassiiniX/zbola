@if($invoice->status == "running")
<div id="modal-review" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border:0px solid red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div> 

      <div class="modal-body">      
		<img src="{{asset('assets/images/modal-review.png')}}" class="img-fluid">

		<form class="mt-4" method="post" action="{{url('user/review')}}">
			{{csrf_field()}}		

			<input type="hidden" name="product_id" value="{{$invoice->product_id}}">		
			
			<div class="form-group">
				<div class="small text-muted">
					Komentar : 
				</div>
				<div>
					<textarea placeholder="Komentar" class="form-control" name="description"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="small text-muted">
					Bintang : 
				</div>
				<div>
					<select class="form-control" name="star">
						<option value="1">Bintang 1</option>
						<option value="2">Bintang 2</option>
						<option value="3">Bintang 3</option>
						<option value="4">Bintang 4</option>
						<option value="5">Bintang 5</option>
					</select>
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
@endif