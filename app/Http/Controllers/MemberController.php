<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Testing\Fluent\Concerns\Has;

class MemberController extends Controller
{
    public function index()
    {
        return view('dashboard.members.members')->with(['members' => User::orderBy('id', 'DESC')->where('family_id',\auth()->user()->family_id)->get()]);
    }


    public function create()
    {
        return view('dashboard.members.create_member');
    }

    public function store(MemberRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = [
            "name" => $request->name,
            "phone" => $request->phone,
            "national_id" => $request->national_id,
            "title" => $request->title,
            "family_id" => auth()->user()->family_id,
            "password" => Hash::make($request->national_id)
        ];
        User::create($data);
        return Redirect::route('members.index')->with('status', 'عضو جدید با موفقیت اضافه شد');

    }


    public function edit($id)
    {
        return view('dashboard.members.update_member')->with('member', User::find($id));
    }


    public function update(MemberRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $data = [
            "name" => $request->name,
            "phone" => $request->phone,
            "national_id" => $request->national_id,
            "title" => $request->title,
            "family_id" => auth()->user()->family_id,
            "password" => Hash::make($request->national_id)
        ];
        User::find($id)->update($data);

        return Redirect::route('members.index')->with('status', 'عضو جدید با موفقیت ویرایش شد');

    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        User::find($id)->delete();
        return Redirect::route('members.index')->with('status', 'عضو با موفقیت حذف شد');
    }
}
