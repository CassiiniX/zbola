<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config as ConfigModel;

class InvoiceController extends Controller
{
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

        return view("user.invoice",[
            "invoice" => $invoice,
            "expiredPayment" => $expiredPayment ?? Null,
            "endRent" => $endRent ?? Null
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

    	return view("user.invoice-history",compact("invoice","search"));
    }
}
