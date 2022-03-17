<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProfilController extends Controller
{
   public function index(){
        $product = Product::query()
            ->where('status','active')
            ->orderBy('id','desc')
            ->paginate(8);

        return response()->json($product);
   }

   public function detail($id){
        $product = Product::query()
            ->with(["reviews.user"])            
            ->where('status','active')
            ->findOrFail($id);

        return response()->json($product);
   }
}
