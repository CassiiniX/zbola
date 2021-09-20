<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class ProfilEditDataRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            "password_confirm" => "required|min:8",
            "phone" => "required|numeric|unique:users,phone,".auth()->user()->id,
        ];

        if(!empty(request()->password)){
            $rules = array_merge([
                "password" => "required|min:8"
            ],$rules);    
        }

        return $rules;
    }
}
