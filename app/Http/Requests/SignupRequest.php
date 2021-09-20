<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class SignupRequest extends FormRequest
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
            "username" => "required|unique:users",
            'email' => 'required|email|unique:users',
            "password" => "required|min:8",
            "phone" => "required|numeric|unique:users",
        ];
    }
}
