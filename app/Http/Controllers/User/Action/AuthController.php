<?php

namespace App\Http\Controllers\User\Action;

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
        auth()->logout();
        
        return redirect()->to("/");
    }

    public function actionSignin(SigninRequest $request){   
        try{      
            throw_if(
                !User::where('email',$request->email)->first(),
                new \Exception("Email tidak ditemukan",422)
            );    

            throw_if(
                !auth()->attempt($request->validated()),
                new \Exception("Password tidak ditemukan",422)
            );

            return FormatResponse::success(
                auth()->user()['role'] == "admin" 
                    ? "/admin" 
                    : "/user","Berhasil Masuk"
                );
        }catch(\Exception $e){
            return FormatResponse::failed($e);
        }
    }

    public function actionSignup(SignupRequest $request){     
        try{
            throw_if(
                !User::create($request->validated()),
                new \Exception("Tidak dapat membuat user",422)
            );

            return FormatResponse::success("/signin","Berhasil membuat akun");
        }catch(\Exception $e){
            return FormatResponse::failed($e);
        }
    }
}
