<?php

namespace App\Http\Controllers\Admin\Action;

use App\Http\Controllers\Controller;
use App\Models\{
	Invoice,
    Product,
    Notification,
    ManualPayment
};
use App\Helpers\FormatResponse;

class InvoiceController extends Controller
{
    public function rejected($id){
        $invoice = Invoice::where('status','pending')
            ->findOrFail($id);

        try{
            \DB::beginTransaction();

            $invoice->update([
                "status" => "rejected"
            ]);

            Product::where("id",$invoice->product_id)->update([
                "rent" => false
            ]);

            Notification::create([
                "user_id" => $invoice->user_id,
                "title" => "Status invoice telah berubah",
                "content" => "Status Invoice #".$invoice->id." telah berubah menjadi DITOLAK"
            ]);

            \DB::commit();

            return FormatResponse::successBack("Berhasil mengubah status");
        }catch(\Exception $e){
            \DB::rollback();

            return FormatResponse::failed($e);
        }
    }

    public function approve($id){        
        $invoice = Invoice::where("status","pending")
            ->findOrFail($id);        

        try{
            \DB::beginTransaction();

            $invoice->update([
                "status" => "payment"
            ]);

            Notification::create([
                "user_id" => $invoice->user_id,
                "title" => "Status invoice telah berubah",
                "content" => "Status Invoice #".$invoice->id." telah berubah menjadi PEMBAYARAN"
            ]);

            \DB::commit();        

            return FormatResponse::successBack("Berhasil mengubah status");
        }catch(\Exception $e){
            \DB::rollback();

            return FormatResponse::failed($e);
        }
    }

    public function waiting($id){        
        $invoice = Invoice::where('status','waiting')
            ->findOrFail($id);

        try{
            \DB::beginTransaction();

            $invoice->update([
                "status" => "running"
            ]);

            Notification::create([
                "user_id" => $invoice->user_id,
                "title" => "Status invoice telah berubah",
                "content" => "Status Invoice #".$invoice->id." telah berubah menjadi BERJALAN"
            ]);

            \DB::commit();

            return FormatResponse::successBack("Berhasil mengubah status");
        }catch(\Exception $e){
            \DB::rollback();

            return FormatResponse::successBack("Berhasil mengubah status");
        }
    }

    public function running($id){        
        $invoice = Invoice::where('status','running')
            ->findOrFail($id);

        try{
            \DB::beginTransaction();

            $invoice->update([
                "status" => "compeleted"
            ]);

            Product::where('id',$invoice->product_id)->update([
                "rent" => false
            ]);

            Notification::create([
                "user_id" => $invoice->user_id,
                "title" => "Status invoice telah berubah",
                "content" => "Status Invoice #".$invoice->id." telah berubah menjadi SELESAI"
            ]);

            \DB::commit();

            return FormatResponse::successBack("Berhasil mengubah status");
        }catch(\Exception $e){
            \DB::rollback();

            return FormatResponse::failed($e);
        }
    }

    public function failed($id){
        $invoice = Invoice::where('status','payment')
            ->findOrFail($id);

        try{
            \DB::beginTransaction();

            $invoice->update([
                "status" => "failed"
            ]);

            Product::where('id',$invoice->product_id)->update([
                "rent" => false
            ]);

            ManualPayment::where('invoice_id',$invoice->id)->update([
                "status" => "failed",
            ]);

            Notification::create([
                "user_id" => $invoice->user_id,
                "title" => "Status invoice telah berubah",
                "content" => "Status Invoice #".$invoice->id." telah berubah menjadi DIGAGALKAN"
            ]);

            \DB::commit();

            return FormatResponse::successBack("Berhasil mengubah status");
        }catch(\Exception $e){
            \DB::rollback();

            return FormatResponse::failed($e);
        }
    }
}
