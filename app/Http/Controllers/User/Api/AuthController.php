<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\{
    SigninRequest,
    SignupRequest
};
use App\Models\User;
use App\Helpers\FormatResponse;

class AuthController extends Controller
{
    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => true
        ]); 
    }

    public function signin(SigninRequest $request){   
        try{      
            throw_if(
                !User::where('email',$request->email)->first(),
                new \Exception("Email tidak ditemukan",422)
            );    

            throw_if(
                !auth('api')->attempt($request->validated()),
                new \Exception("Password tidak ditemukan",422)
            );
                 
            return response()->json([
                'access_token' => auth('api')->user()->createToken('access_token')->plainTextToken,
                'user' => auth('api')->user()
            ]);
        }catch(\Exception $e){
            return FormatResponse::failed($e);
        }
    }

    public function signup(SignupRequest $request){     
        try{
            throw_if(
                !User::create($request->validated()),
                new \Exception("Tidak dapat membuat user",422)
            );
            
            return response()->json([
                "message" => true
            ]);
        }catch(\Exception $e){
            return FormatResponse::failed($e);
        }
    }

    public function me(){
        return response()->json(auth()->user());
    }
}
