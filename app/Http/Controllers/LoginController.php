<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Login;
use Session;

class LoginController extends Controller
{
  public function index() {
    return view('auths.login');
  }

  public function login(Request $req) {
    \Session::put('user_id', $req->user_id);
    return redirect('tasks');
  }
}
