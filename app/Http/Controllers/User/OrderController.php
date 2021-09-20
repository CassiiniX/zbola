<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{
    Product,
    Config as ConfigModel
};

class OrderController extends Controller
{
    public function detail($id){
        $product = Product::query()
            ->where('status','active')            
            ->findOrFail($id);

    	if($product->rent){
    		return redirect()->back()->with([
    			"comeback" => [
    				"message" => "failed",
    				"failed" => "Maaf sepertinya lapangan telah tersewa"
    			]
    		]);
    	}

        $minDate = now()->addDays(intval(ConfigModel::where('name','payment_day')->first()->value)+1)->format("Y-m-d");
        
        $hours = intval(ConfigModel::where('name','hours')->first()->value);

    	return view("user.order",compact('product','minDate','hours'));
    }
}
