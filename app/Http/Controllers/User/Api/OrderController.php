<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\{
	Product,
    Invoice,
    Config as ConfigModel
};
use App\Helpers\FormatResponse;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function detail($id){
        $product = Product::query()
            ->where('status','active')            
            ->findOrFail($id);

        if($product->rent){
            return redirect()->back()->with([
                "comeback" => [
                    "message" => "failed",
                    "failed" => "Maaf sepertinya lapangan telah tersewa"
                ]
            ]);
        }

        $minDate = now()->addDays(intval(ConfigModel::where('name','payment_day')->first()->value)+1)->format("Y-m-d");
        
        $hours = intval(ConfigModel::where('name','hours')->first()->value);

        return response()->json([
            "product" => $product,
            "min_date" => $minDate,
            "hours" => $hours
        ]);
    }

    public function order(OrderRequest $request){
        try{
            \DB::beginTransaction();

            throw_if(
                !date('Y-m-d',strtotime($request->date_start)) === $request->date_start,
                new \Exception("Tanggal mulai tidak valid",422)
            );     

            throw_if(
                !now()->addDays(intval(ConfigModel::where('name','payment_day')->first()->value))->isBefore(now()->create($request->date_start)),
                new \Exception("Tanggal mulai tidak valid",422)                
            );

            throw_if(
                intval($request->hours) > intval(ConfigModel::where('name','hours')->first()->value),
                new \Exception("Jam tidak valid",422)
            );

            throw_if(
                auth()->user()->invoices()->whereIn('status',['pending','payment','running','waiting'])->first(),
                new \Exception("Maaf anda masih memiliki invoice yang aktif",422)
            );
            
            throw_if(
                !$product = Product::where("id",$request->product)->where("status","active")->where("rent",false)->first(),
                new \Exception("Product tidak ditemukan",422)
            );
            
            auth()->user()->invoices()->create([
                "product_id" => $request->product,
                "total" => $product->price * $request->hours,
                "start_rent" => $request->date_start." ".$request->hour_start.":00:00",
                "hour" => $request->hours
            ]);
              
            $product->update([
                "rent" => true
            ]);

            \DB::commit();

            return response()->json([
                "message" => "Berhasil membuat invoice"
            ]);
        }catch(\Exception $e){
            \DB::rollback();    

            return FormatResponse::failed($e);
        }
    }
}
