<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ownerSignupReuqest;
use App\Http\Requests\RegisterRequest;
use App\Models\Family;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class authController extends Controller
{
    public function login()
    {
        return view('welcome');
    }
    public function ownerSignin(LoginRequest $request) {
        $phone = $request->phone;
        $password = $request->password;

        if (Auth::attempt(['phone' => $phone, 'password' => $password])) {
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

    public function ownerSignup(ownerSignupReuqest $request){
        DB::beginTransaction();

        $family = Family::create([]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'family_id' => $family->id,
            'family_owner' => $family->id,
            'national_id' => $request->national_id,
            'title' => $request->title,
        ];
        $user = User::create($data);
        $family->update(['owner_id'=>$user->id]);
        DB::commit();
        return Redirect::route('login')->with(['status'=>'خانواده با موفقیت تشکیل شد میتوانید از بخش ورود سرپرست وارد شوید']);
    }

}
