<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Invoice,
	ManualPayment
};

class ReportController extends Controller
{
    public function index(){
    	return view("admin.report");
    }

    public function invoice(Request $request){
    	try{
            throw_if(
                empty($request->start_date),
                new \Exception("Terjadi Kesalahan")
            );

            throw_if(
                empty($request->end_date),
                new \Exception("Terjadi Kesalahan")
            );            

    		$start_date = now()->parse($request->start_date)->setTime(0,0,0);
    		$end_date = now()->parse($request->end_date)->setTime(23,59,59);

    		throw_if(
                !$start_date->isBefore($end_date),
                new \Exception("Terjadi Kesalahan")
            );
    		
    		$invoice = Invoice::query()
                ->with(['product','user'])
    			->whereBetween("created_at",[$start_date->toDateTimeString(),$end_date->toDateTimeString()])
                ->orderBy('id','desc')
    			->get();

    		$sub_total = Invoice::query()
                ->select(
    				\DB::raw("sum(total) as total")
    			)
    			->whereBetween("created_at",[$start_date->toDateTimeString(),$end_date->toDateTimeString()])
    			->first()
    			->total;

    		return view("report.invoice",compact("invoice","sub_total","start_date","end_date"));
    	}catch(\Exception $e){
            \Log::channel("coex")->info($e->getMessage());
            
    		abort(404);
    	}
    }
}
