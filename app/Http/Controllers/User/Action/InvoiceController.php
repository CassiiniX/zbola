<?php

namespace App\Http\Controllers\User\Action;

use App\Http\Controllers\Controller;
use App\Models\{
	Product,
    ManualPayment
};
use App\Helpers\FormatResponse;

class InvoiceController extends Controller
{
    public function cancel(){	
        $invoice = auth()->user()->invoices()
            ->whereIn('status',['pending','running','waiting','payment'])
            ->firstOrFail();    

    	$product = Product::findOrFail($invoice->product_id);

    	try{    	
    		\DB::beginTransaction();

    		$invoice->update([
    			"status" => $invoice->status == "running" ? "failed" : "canceled"
    		]);

    		$product->update([
    			"rent" => false
    		]);

            ManualPayment::where('invoice_id',$invoice->id)->update([
                "status" => "failed",
            ]);

    		\DB::commit();

            return FormatRespone::success("/user/history-invoice","Berhasil membatalkan invoice");    	
    	}catch(\Exception $e){
    		\DB::rollback();

    		return FormatRespone::failed($e);
    	}
    }
}
