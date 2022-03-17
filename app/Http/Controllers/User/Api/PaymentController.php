<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Uploads\UploadPaymentPhoto;
use App\Helpers\FormatResponse;

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
        
        return response()->json([
            "manul_payment" => $manualPayment,    
        ]);    
    }

    public function payment(PaymentRequest $request){    
        try{              
            $invoice = auth()->user()->invoices()
                ->where('status','payment')
                ->firstOrFail(); 

            auth()->user()->manual_payments()->create([
              "description" => $request->description,
              "invoice_id" => $invoice->id,
              "proof" => UploadPaymentPhoto::upload()
            ]);

            return response()->json([
                "message" => "Berhasil,Tunggu 1x24 jam untuk validasi pembayaran oleh admin"
            ]);
        }catch(\Exception $e){
            return FormatResponse::failed($e);
        }
    }
}
