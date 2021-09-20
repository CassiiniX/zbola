<?php 

namespace App\Uploads;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadProductPhoto{
	public static function public_path(){
		return public_path() . "/assets/images/products/";
	}

	public static function upload($image){  
        $fileName = Str::random("16") . '.' . $image->getClientOriginalExtension();      
              
        Image::make($image)
        ->resize(null, 400, function($constraint){
            return $constraint->aspectRatio();
        })
        ->save(self::public_path() . $fileName);

        return $fileName;
	}

	public static function delete($oldPhoto){		
		if(!in_array($oldPhoto, ["default.png","product.png"])){   		
    	    if(file_exists(self::public_path() . $oldPhoto)){    	     
	           unlink(self::public_path() . $oldPhoto);
          	}
        }	
	}
}