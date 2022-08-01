<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'photo' => 'max:150|mimes:jpeg,jpg,png',
            'debt' => 'min:0'
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'لطفا نام مشتری را وارد کنید',

            'photo.max' => 'حداکثر حجم عکس بایت ۱۵۰ کیلو بایت باشد',
            'photo.mimes' => 'فرمت فایل انتخاب شده نادرست است مقادیر مجاز : jpg jpeg png',

            'debt.min' => 'مبلغ بدهی نمیتواند منفی باشد',
        ];
    }
}
