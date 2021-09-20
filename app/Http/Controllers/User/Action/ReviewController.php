<?php

namespace App\Http\Controllers\User\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Review,	
	Product
};
use App\Helpers\FormatResponse;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function review(ReviewRequest $request){    	
        $invoice = auth()->user()->invoices()
            ->whereIn('status',['running'])
            ->firstOrFail();    

        try{
        	\DB::beginTransaction();

            auth()->user()->reviewes()
                ->create($request->only("product_id","star","description"));            
        
            $review = Review::query()
                ->select(
                    \DB::raw("count(id) as amount"),
                    \DB::raw("sum(star) as star")
                )
                ->where('product_id',$invoice->product_id)
                ->first();    
        
            $star = $review->amount > 0 
                    ? round( $review->star / $review->amount ) 
                    : 0;

            Product::where('id',$invoice->product_id)
                ->update([
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
