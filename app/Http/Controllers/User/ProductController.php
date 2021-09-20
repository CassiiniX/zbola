<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){    
    	$product = Product::query()
    		->where('status','active')
    		->orderBy('id','desc')
    		->paginate(8);

    	return view("user.product",compact('product'));
    }

    public function detail($id){   
    	$product = Product::query()
            ->with(["reviews.user"])            
            ->where('status','active')
    		->findOrFail($id);    	

    	return view("user.product-detail",compact("product"));
    }
}
