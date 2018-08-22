<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Login;

class LoginController extends Controller
{
  public function index() {
    return view('auths.login');
  }
}
