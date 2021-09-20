<?php

namespace App\Http\Controllers\Admin\Action;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\Admin\{
  ProductCreateRequest,
  ProductEditRequest
};
use App\Uploads\UploadProductPhoto;
use App\Helpers\FormatResponse;

class ProductController extends Controller
{
    public function create(ProductCreateRequest $request){
      try{
        $payload = $request->only("address","description","fasilitas","quesation","price","status");

        $payload["images"] = [];

        for($i=1;$i<4;$i++){
          if($request->hasFile('image'.$i)){
              $payload["images"][] = UploadProductPhoto::upload($request->file('image'.$i));
          }
        }

        $payload["images"] = json_encode($payload["images"]);

        Product::create($payload);

        return FormatResponse::successBack("Berhasil tambah product");
      }catch(\Exception $e){
        return FormatResponse::failed($e);
      }
    }

    public function edit(ProductEditRequest $request,Product $product){
        try{
          $payload = $request->only("address","description","fasilitas","quesation","price","status");

          $payload["images"] = [];

          for($i=1;$i<4;$i++){
            if($request->hasFile('image'.$i)){
                $payload["images"][] = UploadProductPhoto::upload($request->file('image'.$i));        

                if(isset($product->get_images[$i-1])){
                  UploadProductPhoto::delete($product->get_images[$i-1]);
                }
            }
          }
        
          if(count($payload["images"])){
            $payload["images"] = json_encode($payload["images"]);
          }else{
            unset($payload["images"]);
          }

          $product->update($payload);

          return FormatResponse::successBack("Berhasil edit product");
      }catch(\Exception $e){
          return FormatResponse::failed($e);
      }
    }
}