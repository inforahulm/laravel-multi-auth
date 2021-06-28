<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function check(Request $request)
    {
       
      $request->validate([
        'email' => ['required', 'string', 'email', 'max:255', 'exists:admins'],
        'password' => ['required', 'string', 'min:8'],
      ]);
      $users=$request->only('email','password');
    
      if(Auth::guard('admin')->attempt($users)){
        return redirect()->route('admin.home');
      }
      else{
          return redirect()->route('admin.login')->with('fail','Incorrect users');
      }
    
    }

    function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}

