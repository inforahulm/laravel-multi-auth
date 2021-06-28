<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function create(Request $request)
    {
      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
      $employee= Employee::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),  
    ]);
      return redirect()->back()->with('success','Register successfully');
    }

    public function check(Request $request)
    {
      $request->validate([
        'email' => ['required', 'string', 'email', 'max:255', 'exists:employees'],
        'password' => ['required', 'string', 'min:8'],
      ]);
      $employee=$request->only('email','password');
      if(Auth::guard('employee')->attempt($employee)){
        return redirect()->route('employee.home');
      }
      else{
          return redirect()->route('employee.login')->with('fail','Incorrect users');
      }
    
    }

    function logout(){
        Auth::guard('employee')->logout();
        return redirect('/');
    }
}
