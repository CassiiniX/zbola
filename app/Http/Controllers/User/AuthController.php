<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function signin(){
    	return view("signin");
    }

    public function signup(){
    	return view("signup");
    }
}
