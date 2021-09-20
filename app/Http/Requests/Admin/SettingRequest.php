<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class SettingRequest extends FormRequest
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
            "site_name" => "required",
            "payment_day" => "required|integer",
            "hours" => "required|integer",
            "maintaince" => "required"     
        ];
    }
}
