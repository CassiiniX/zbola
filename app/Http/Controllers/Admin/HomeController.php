<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
	Invoice,
	User,
	Review,
	ManualPayment,
	Product
};

class HomeController extends Controller
{
    public function index(){    	
    	$chart = [];

		for($i=1;$i<11;$i++){
			$dataLabel = now()->subDays($i)->format("M d");
			$theDay = now()->subDays($i)->setTime(0,0,0)->toDateTimeString();			
			$theLastDay = now()->subDays($i)->setTime(23,59,59)->toDateTimeString();

			$dataY = Invoice::select(
					\DB::raw('count(*) as amount')
				)
				->where('status','compeleted')
				->where("created_at",">",$theDay)
				->where("created_at","<",$theLastDay)
				->first()
				->amount;	

			$chart[] = [
				"y" => $dataY,
				"label" => $dataLabel
			];
		}

    	$data = [
			"user" => [
				"total_user" => User::select(\DB::raw("count(*) as amount"))
					->first()
					->amount,
				"total_admin" => User::select(\DB::raw("count(*) as amount"))
					->where('role','admin')
					->first()
					->amount,
				"total_new_user" => User::select(\DB::raw("count(*) as amount"))
					->where('created_at','>',now()->subDays(3)->toDateTimeString())
					->first()
					->amount,
				"new_user" => User::orderBy("id","desc")
					->where("created_at",">",now()->subDays(3)->toDateTimeString())
					->take(5)
					->get()
			],
			"invoice" => [
				"total_invoice" => Invoice::select(\DB::raw("count(*) as amount"))
					->first()
					->amount,
				"total_invoice_pending" => Invoice::select(\DB::raw("count(*) as amount"))
					->where('status','pending')
					->first()
					->amount,
				"total_new_invoice" => Invoice::select(\DB::raw("count(*) as amount"))
					->where('created_at','>',now()->subDays(3)->toDateTimeString())
					->first()
					->amount
			],
			"product" => [
				"total_product" => Product::select(\DB::raw("count(*) as amount"))
					->first()
					->amount,
				"total_product_nonactive" => Product::select(\DB::raw("count(*) as amount"))
					->where('status','nonactive')
					->first()
					->amount
			],
			"payment" => [
				"total_payment" => ManualPayment::select(\DB::raw("count(*) as amount"))
					->first()
					->amount,
				"total_payment_validasi" => ManualPayment::select(\DB::raw("count(*) as amount"))
					->where('status','validasi')
					->first()
					->amount,
				"total_new_payment" => ManualPayment::select(\DB::raw("count(*) as amount"))
					->where("created_at",">",now()->subDays(3)->toDateTimeString())
					->first()
					->amount
			],
			"review" => [
				"total_new_review" => Review::select(\DB::raw("count(*) as amount"))
					->where('created_at','>',now()->subDays(3)->toDateTimeString())
					->first()
					->amount
			],
			"chart" => $chart
    	];    

    	return view("admin.home",$data);
    }
}