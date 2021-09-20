<?php 

namespace App\Uploads;

use Illuminate\Support\Str;

class UploadPaymentPhoto{
	public static function public_path(){
		return public_path() . "/assets/images/proofs/";
	}

	public static function upload(){
		$image = request()->file('proof');

        $fileName = Str::random("16") . '.' . $image->getClientOriginalExtension();
       
        $image->move(self::public_path(),self::public_path() . "" . $fileName);        
        
        return $fileName;
	}
}