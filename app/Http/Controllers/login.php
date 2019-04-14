<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Users;
use Illuminate\Http\Request;

class login extends Controller
{
    function login(Request $kiriman){
    	$data_admin= Admin::where('username',$kiriman->username)->where('password',$kiriman->password)->get();
    	$data_users= Users::where('email',$kiriman->username)->where('password',$kiriman->password)->get();

    	if(count($data_admin)>0){
    		Auth::guard('admin')->LoginUsingId($data_admin[0]['id']);
    		return redirect('/admin');

    	}else if(count($data_users)>0){
    		Auth::guard('users')->LoginUsingId($data_users[0]['id']);
    		return redirect('/users');
    	}else{
    		return "login gagal";
    	}
    }

    function keluar(){
    	if(Auth::guard('admin')->cheack()){
    		Auth::guard('admin')->logout();
    	}else if(Auth::guard('users')->check()){
    		Auth::guard('users')->logout();
    	}
    	return redirect('/login');
    }
}
