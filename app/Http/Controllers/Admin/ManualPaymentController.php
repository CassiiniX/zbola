<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManualPayment;

class ManualPaymentController extends Controller
{
    public function index(Request $request){
    	$search = $request->search ?? Null;

    	$manualPayment = ManualPayment::query()
            ->with("user");

    	if($search){
    		$manualPayment = $manualPayment->where(function($query) use ($search){
	    		$query->orWhere('id',$search)
	    			->orWhere("invoice_id",$search)
	    			->orWhere("description",$search)
	    			->orWhere("status",$search);
	    	});
    	}

    	$manualPayment = $manualPayment->orderBy('id','desc')
    		->paginate(10);

    	return view("admin.manual-payment",compact("manualPayment","search"));
    }

    public function detail($id){
        $manualPayment = ManualPayment::query()
            ->with(["invoice.manual_payment"])
            ->findOrFail($id);

        $isValidasi = ManualPayment::query()
            ->where('invoice_id',$manualPayment->invoice_id)
            ->where('status','validasi')
            ->count();

        return view("admin.manual-payment-detail",compact("manualPayment","isValidasi"));
    }
}
