<?php

namespace App\Http\Controllers\Admin\Action;

use App\Http\Controllers\Controller;
use App\Models\{
	Review,
    Product
};
use App\Helpers\FormatResponse;

class ReviewController extends Controller
{
	public function delete(Review $review){		
    	try{
        	\DB::beginTransaction();

			$review->delete();

        	$review = Review::query()
                ->select(
        		  \DB::raw("count(id) as amount"),
        		  \DB::raw("sum(star) as star")
        	    )
        		->where('product_id',$review->product_id)
        		->first();
    
        	$star = $review->amount > 0 ? round( $review->star / $review->amount ) : 0;                
                
        	Product::where('id',$review->product_id)->update([
        		  "star" => $star
        	    ]);

        	\DB::commit();

            return FormatResponse::successBack("Berhasil memberikan review");
        }catch(\Exception $e){
        	\DB::rollback();

            return FormatResponse::failed($e);
        }
	}
}