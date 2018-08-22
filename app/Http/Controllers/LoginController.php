<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Login;

class LoginController extends Controller
{
  public function index() {
    return view('auths.login');
  }
  public function login(Request $request) 
  {
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'password' => 'required|min:8',
    ]);
      if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
      }
    
  }
}
