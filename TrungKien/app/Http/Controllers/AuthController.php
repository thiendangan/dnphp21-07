<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
      public function login(LoginRequest $request)
      {
            $adminName = $request->name;
            $admin_password = $request->password;
            if (Auth::attempt(['name' => $adminName, 'password' => $admin_password])) {
                  $request->session()->put('userName', Auth::user()->name);
                  return redirect()->route('product.index');
            } else
                  return view('login')->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
      }
      public function logout()
      {
            Auth::logout();
            session()->forget('userName');
            return redirect()->route('login');
      }
}
