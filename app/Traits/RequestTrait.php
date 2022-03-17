<?php
namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait RequestTrait{
	/**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /** 
     * Custom Error
     *
     * @return json     
    */
    public function failedValidation(Validator $validator){    
        if(!request()->isJson()){
            throw new HttpResponseException(
                back()
                ->withInput()
                ->with([
                    "comeback" => [
                        "message" => "failed",
                        "failed" => $validator->errors()->first()
                    ]
                ])
            );
        }else{
            throw new HttpResponseException(
                response()->json([
                    "failed" => $validator->errors()->first()
                ],422)
            );  
        }
    }
}