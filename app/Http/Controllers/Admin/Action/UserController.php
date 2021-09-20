<?php

namespace App\Http\Controllers\Admin\Action;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;
use App\Helpers\FormatResponse;

class UserController extends Controller
{
    public function edit(UserRequest $request,User $user){      
        try{
            throw_if(
                !in_array($request->role,['user','admin']),
                new \Exception("Role tidak valid",422)
            ); 

            $payload = $request->only("email","phone","role");

            if(!empty($request->password)){
                $payload['password'] = $request->password;
            }

            $user->update($payload);

            return FormatResponse::successBack("Berhasil mengedit user");
        }catch(\Exception $e){
            return FormatResponse::failed($e);
        }
    }
}