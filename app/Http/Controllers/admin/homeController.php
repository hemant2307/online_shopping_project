<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function dashboard(){

        return view('admin.dashboard');
    }


    public function logout(){
        Auth::guard('admin')->logout();

        return view('admin.login');
    }
}
