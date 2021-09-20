<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Invoice,
    Config as ConfigModel
};

class InvoiceController extends Controller
{
    public function index(Request $request){
		$search = $request->search ?? Null;
    
        $invoice = Invoice::query()
            ->with(["user","product"]);

    	if($search){
    		$invoice = $invoice->where(function($query) use ($search){
	    		$query->orWhere('id',$search)
	    			->orWhere("status",$search)
	    			->orWhere("hour",$search)
	    			->orWhere("total",$search);
    		});
    	}

    	$invoice = $invoice->orderBy('id','desc')
    		->paginate(10);

    	return view("admin.invoice",compact("invoice","search"));  
    }

    public function detail($id){    
        $invoice = Invoice::query()
            ->with(["user","product","manual_payment"])
            ->findOrFail($id);

        $isLate = now()->isAfter(now()->parse($invoice->created_at)
                ->addDays(intval(ConfigModel::where('name','payment_day')->first()->value)));

        return view("admin.invoice-detail",compact("invoice","isLate"));
    }
}
