<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Config as ConfigModel;

class HomeController extends Controller
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

    	return view("user.home",[
            "invoice" => $invoice,
            "expiredPayment" => $expiredPayment ?? Null,
            "endRent" => $endRent ?? Null
        ]);
    }
}