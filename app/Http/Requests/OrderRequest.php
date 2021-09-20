<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class OrderRequest extends FormRequest
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
            'product' => 'required|integer',
            'date_start' => 'required',
            'hour_start' => 'required|integer',
            'hours' => 'required|integer'         
        ];
    }
}
