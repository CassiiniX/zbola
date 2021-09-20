<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
	public function index(Request $request){
		$search = $request->search ?? Null;

        $review = Review::query()
            ->with(["user","product"]);

    	if($search){
    		$review = $review->where(function($query) use ($search){
	    		$query->orWhere('id',$search)
	    			->orWhere('star',$search)
	    			->orWhere('description',$search);
    		});
    	}

    	$review = $review->orderBy('id','desc')
    		->paginate(10);

    	return view("admin.review",compact("review","search"));
	}
}