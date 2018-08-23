<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Auth;
use DB;
class AuthController extends Controller {

  public function loginView() {
    return view('auths.login');
  }

  public function login(Request $request) {

    $validator = Validator::make($request->all(), [
      'email' => 'required',
      'password' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect('/')
          ->withInput()
          ->withErrors($validator);
    }

    $email = $request->input('email');
    $password = $request->input('password');
    $checkLogin = DB::table('users')->where(['email'=>$email])->get();

    if (count($checkLogin) > 0) {
      foreach($checkLogin as $value) {
        if (Hash::check($password, $value->password)) {
          echo "Login Successful! <br>";
          echo "user_id: $value->user_id";
        }
        else {
          $validator->errors()->add('email', 'Email or password are wrong, please type again!');
          return redirect('/')->withErrors($validator);
        }
      }
    }
    else {
      $validator->errors()->add('email', 'Email or password are wrong, please type again!');
      return redirect('/')->withErrors($validator);
    }
  }
  public function registerView() {
    return view('auths.register');
  }
  public function register(Request $request) 
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'email' => 'required|email:true|unique:users',
      'password' => 'required|min:8|confirmed',
      'confirm' => 'required|min:8',
    ]);
    if ($validator->fails()) {
      return redirect('/register')
          ->withInput()
          ->withErrors($validator);
    }
    return redirect('/');
  }
}
