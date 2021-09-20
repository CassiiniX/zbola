<?php

namespace App\Http\Controllers\Admin\Action;

use App\Http\Controllers\Controller;
use App\Models\{
	ManualPayment,
    Invoice,
    Notification
};
use App\Helpers\FormatResponse;

class ManualPaymentController extends Controller
{
    public function success($id){   
        $manualPayment = ManualPayment::where('status','validasi')
            ->findOrFail($id);

        try{
            \DB::beginTransaction();

            $manualPayment->update([
                "status" => "success"
            ]);

            Notification::create([
                "user_id" => $manualPayment->user_id,
                "title" => "Pembayaran berhasil divalidasi",
                "content" => "Pembayaran #".$manualPayment->id." berhasil divalidasi"
            ]);

            \DB::commit();

            return FormatResponse::successBack("Berhasil mengubah status");
        }catch(\Exception $e){
            \DB::rollback();

            return FormatResponse::failed($e);
        }
    }

    public function failed($id){        
        $manualPayment = ManualPayment::where('status','validasi')
            ->findOrFail($id);

        try{
            \DB::beginTransaction();

            $manualPayment->update([
                "status" => "failed"
            ]);

            Notification::create([
                "user_id" => $manualPayment->user_id,
                "title" => "Pembayaran gagal divalidasi",
                "content" => "Pembayaran #".$manualPayment->id." gagal divalidasi"
            ]);

            \DB::commit();

            return FormatResponse::successBack("Berhasil mengubah status");
        }catch(\Exception $e){            
            \DB::rollback();

            return FormatResponse::failed($e);
        }
    }

    public function completed($id){    
        $invoice = Invoice::where('status','payment')
            ->findOrFail($id);

        try{
            \DB::beginTransaction();

            $invoice->update([
                "status" => "waiting"
            ]);

            Notification::create([
                "user_id" => $invoice->user_id,
                "title" => "Status invoice telah berubah",
                "content" => "Status Invoice #".$invoice->id." telah berubah menjadi MENUNGGU"
            ]);

            \DB::commit();

            return FormatResponse::success("admin/invoice/detail/".$invoice->id,"Berhasil mengubah status");
        }catch(\Exception $e){
            \DB::rollback();

            return FormatResponse::failed($e);
        }
    }
}
