<?php

namespace App\Http\Controllers\Admin\Action;

use App\Http\Controllers\Controller;
use App\Models\Config as ConfigModel;
use App\Http\Requests\Admin\SettingRequest;
use App\Helpers\FormatResponse;

class SettingController extends Controller
{      
    public function update(SettingRequest $request){ 
      try{
          \DB::beginTransaction();

          ConfigModel::where('name','site_name')->update([
        	 "value" => $request->site_name
          ]);

          ConfigModel::where('name','payment_day')->update([
          	"value" => $request->payment_day
          ]);

          ConfigModel::where('name','hours')->update([
          	"value" => $request->hours 
          ]);

          ConfigModel::where("name","maintaince")->update([
            "value" => $request->maintaince
          ]);

          \DB::commit();

          return FormatResponse::successBack("Berhasil Update");
        }catch(\Exception $e){
          \DB::rollback();

          return FormatResponse::failed($e);
        }
    }
}
