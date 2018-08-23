<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
  public function index() {
    return view('auths.register');
  }
  public function register(Request $request) 
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'email' => 'required|email:true',
      'password' => 'required|min:8',
      'confirm' => 'required|min:8',
    ]);
      if ($validator->fails()) {
        return redirect('/register')
            ->withInput()
            ->withErrors($validator);
      }
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make('$request->password');
    $user->remember_token = 0;
    $user->save();
    return redirect('/');
  }
}
