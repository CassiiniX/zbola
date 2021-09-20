<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request){
      $search = $request->search ?? Null;

      $manualPayment = auth()->user()->manual_payments()
          ->with(["invoice","invoice.product"]);
      
      if($search){
        $manualPayment = $manualPayment->where(function($query) use ($search){
          $query->orWhere('id',$search)
              ->orWhere('description',$search)
              ->orWhere('status',$search);
        });
      }

      $manualPayment = $manualPayment        
        ->orderBy('id','desc')
        ->paginate(8);

      return view("user.manual-payment",compact('manualPayment','search'));
    }
}
