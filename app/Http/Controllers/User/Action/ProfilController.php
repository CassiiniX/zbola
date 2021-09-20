<?php

namespace App\Http\Controllers\User\Action;

use App\Http\Controllers\Controller;
use App\Http\Requests\{
  ProfilEditDataRequest,
  ProfilEditPhotoRequest
};
use App\Uploads\UploadProfilPhoto;
use App\Helpers\FormatResponse;

class ProfilController extends Controller
{
    public function editData(ProfilEditDataRequest $request){    
      try{
        throw_if(
            !\Hash::check($request->password_confirm,auth()->user()->password),
            new \Exception("Password konfirmasi tidak valid",422)
        );    

        $payload = $request->only(["email","phone"]);

        if(!empty($request->password)){
            $payload["password"] = $request->password;
        }
      
        auth()->user()->update($payload);

        return FormatResponse::successBack("Berhasil mengedit data");
      }catch(\Exception $e){
        return FormatResponse::failed($e);
      }
    }

    public function editPhoto(ProfilEditPhotoRequest $request){
      try{
        $oldPhoto = auth()->user()->photo_original;

        auth()->user()->update([
            "photo" => UploadProfilPhoto::upload()
        ]);

        UploadProfilPhoto::delete($oldPhoto);

        return FormatResponse::successBack("Berhasil mengedit photo");
      }catch(\Exception $e){
        return FormatResponse::failed($e);
      }
    }  
}
