<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'phone.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'password.required' => 'لطفا رمز عبور خود را وارد کنید',
        ];
    }
}
