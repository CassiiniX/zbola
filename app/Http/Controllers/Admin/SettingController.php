<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config as ConfigModel;

class SettingController extends Controller
{
    public function index(){
		foreach(ConfigModel::all() as $item){
			\Config::set("app.".$item->name,$item->value);
		}

    	return view("admin.setting");
    }
}
