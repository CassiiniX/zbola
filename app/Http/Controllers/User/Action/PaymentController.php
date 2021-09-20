<?php

namespace App\Http\Controllers\User\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Uploads\UploadPaymentPhoto;
use App\Helpers\FormatResponse;

class PaymentController extends Controller
{
    public function payment(PaymentRequest $request){    
        $invoice = auth()->user()->invoices()
            ->where('status','payment')
            ->firstOrFail(); 

        try{              
            auth()->user()->manual_payments()->create([
              "description" => $request->description,
              "invoice_id" => $invoice->id,
              "proof" => UploadPaymentPhoto::upload()
            ]);

            return FormatResponse::success("/user/manual-payment","Berhasil,Tunggu 1x24 jam untuk validasi pembayaran oleh admin");
        }catch(\Exception $e){
            return FormatResponse::failed($e);
        }
    }
}
