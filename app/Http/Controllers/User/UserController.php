<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function create(Request $request)
    {
      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
      $user= User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),  
    ]);
      return redirect()->back()->with('success','Register successfully');
    }

    public function check(Request $request)
    {
      $request->validate([
        'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
        'password' => ['required', 'string', 'min:8'],
      ]);
      $users=$request->only('email','password');
      if(Auth::guard('web')->attempt($users)){
        return redirect()->route('user.home');
      }
      else{
          return redirect()->route('user.login')->with('fail','Incorrect users');
      }
    
    }

    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
