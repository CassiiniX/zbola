<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){
    	$search = $request->search ?? Null;

    	$product = new Product();

    	if($search){
    		$product = $product->where(function($query) use ($search){
	    		$query->orWhere('id',$search)
	    			->orWhere('address',$search)
	    			->orWhere('price',$search)
	    			->orWhere('status',$search)
	    			->orWhere('star',$search);
    		});
    	}

    	$product = $product->orderBy('id','desc')
    		->paginate(10);

    	return view("admin.product",compact("product","search"));  
    }
}