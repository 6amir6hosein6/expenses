<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ownerSignupReuqest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'national_id' => 'required|unique:users',
            'title' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'لطفا نام خود را وارد کنید',
            'phone.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'phone.unique' => 'این شماره قبلا استفاده شده است',
            'password.required' => 'لطفا پسورد خود را وارد کنید',
            'password.confirmed' => 'پسورد مطابقت ندارد',
            'password.min' => 'پسورد حداقل ۶ کاراکتر باشد',

            'national_id.required' => 'لطفا کدملی خود را وارد کنید',
            'national_id.unique' => 'کدملی قبلا استفاده شده است',

            'title.required' => 'لطفا عنوان خود را وارد کنید',

        ];
    }
}
