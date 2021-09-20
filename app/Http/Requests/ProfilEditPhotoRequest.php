<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class ProfilEditPhotoRequest extends FormRequest
{
    use RequestTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "photo" => "required|image|mimes:image/jpeg,image/jpg,image/gif,image/png,jpeg,jpg,gif,png|max:10024|dimensions:max_width=5000,max_height=5000"
        ];
    }
}
