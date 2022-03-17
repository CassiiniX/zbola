<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\{
	Product,
    ManualPayment
};
use App\Helpers\FormatResponse;
use App\Models\Config as ConfigModel;

class InvoiceController extends Controller
{
    public function cancel(){	
		try{    	
			\DB::beginTransaction();

        	$invoice = auth()->user()->invoices()
	            ->whereIn('status',['pending','running','waiting','payment'])
            	->firstOrFail();    

    		$product = Product::findOrFail($invoice->product_id);

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

            return response()->json([
				"message" => "Berhasil membatalkan invoice"
			]);
    	}catch(\Exception $e){
    		\DB::rollback();

    		return FormatResponse::failed($e);
    	}
    }

	public function index(){
		$invoice = auth()->user()->invoices()
			->with(["product","manual_payment"])
			->whereIn('status',['pending','running','waiting','payment'])
			->first();      

		if($invoice){
			$expiredPayment = now()->parse($invoice->created_at)
				->addDays(intval(ConfigModel::where('name','payment_day')->first()->value))
				->toDateTimeString();
				
			$endRent = now()->parse($invoice->start_rent)
				->addHours($invoice->hour)
				->toDateTimeString();
		}

		return response()->json([
			"invoice" => $invoice,
			"expired_payment" => $expiredPayment,
			"end_rent" => $endRent
		]);		
	}

	public function history(Request $request){
		$search = $request->search ?? Null;

    	$invoice = auth()->user()->invoices()
            ->with("product");

        if($search){
            $invoice = $invoice->where(function($query) use ($search){
                $query->orWhere('id',$search)
                    ->orWhere('status',$search)
                    ->orWhere('hour',$search)
                    ->orWhere('total',$search);
            });
        }

        $invoice = $invoice->orderBy('id','desc')
    		->paginate(10);

		return response()->json($invoice);
	}
}
