<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
    	$search = $request->search ?? Null;

    	$user = new User();

    	if($search){
    		$user = $user->where(function($query) use ($search){
	    		$query->orWhere('id',$search)
	    			->orWhere('username',$search)
	    			->orWhere('email',$search)
	    			->orWhere('role',$search)
	    			->orWhere('phone',$search);
    		});
    	}

    	$user = $user->orderBy('id','desc')
    		->paginate(10);

    	return view("admin.user",compact("user","search"));
    }
}
