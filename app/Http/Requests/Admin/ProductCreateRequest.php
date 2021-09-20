<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class ProductCreateRequest extends FormRequest
{
    use RequestTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [           
            'address' => 'required',
            "price" => "required|integer",
            "status" => "required",
            "description" => "required",
            "fasilitas" => "required",
            "quesation" => "required",
            "image1" => "required|image|mimes:image/jpeg,image/jpg,image/gif,image/png,jpeg,jpg,gif,png|max:10024|dimensions:max_width=5000,max_height=5000"
        ]; 

        if(request()->hasFile('image2')){
          $rules = array_merge($rules,[
            "image2" => "required|image|mimes:image/jpeg,image/jpg,image/gif,image/png,jpeg,jpg,gif,png|max:10024|dimensions:max_width=5000,max_height=5000"
          ]);
        }

        if(request()->hasFile('image3')){
          $rules = array_merge($rules,[
            "image3" => "required|image|mimes:image/jpeg,image/jpg,image/gif,image/png,jpeg,jpg,gif,png|max:10024|dimensions:max_width=5000,max_height=5000"
          ]);
        }

        return $rules;
    }
}
