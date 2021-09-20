<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function index(){
    	return view("user.profil");
    }
}
