<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class UserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            "phone" => "required|numeric|unique:users,phone,".$this->user->id,
            "role"  => "required"
        ];

        if(!empty(request()->password)){
            $rules = array_merge([
                "password" => "required|min:8"
            ],$rules);
        }

        return $rules;
    }
}
