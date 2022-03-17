<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\Config as ConfigModel;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
   public function index(Request $request){
        auth()->user()->notifications()->update([
            "read" => true 
        ]);    

        $search = $request->search ?? Null;

        $notification = auth()->user()->notifications();

        if($search){
            $notification = $notification->where(function($query) use ($search){
                $query->orWhere('id',$search)
                    ->orWhere('title',$search)
                    ->orWhere('content',$search);                    
            });
        }

        $notification = $notification
            ->orderBy('id','desc')
            ->paginate(10);

        return response()->json($notification);
   }
}
