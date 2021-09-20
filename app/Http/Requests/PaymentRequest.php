<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class PaymentRequest extends FormRequest
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
            "description" => "required",
            "proof" => "required|image|mimes:image/jpeg,image/jpg,image/gif,image/png,jpeg,jpg,gif,png|max:10024|dimensions:max_width=5000,max_height=5000"
        ];
    }
}
