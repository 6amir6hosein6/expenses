<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class authController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function signin(LoginRequest $request) {
        $phone = $request->phone;
        $password = $request->password;
        if (Auth::attempt(['phone' => $phone, 'password' => $password],1)) {
            return redirect()->route('home');
        }
        return Redirect::back()->withErrors([
            'wrong_inf' => 'اطلاعات وارد شده صحیح نمی باشد'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}
