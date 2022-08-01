<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SafiRequest extends FormRequest
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
            'date' => ['required', 'regex:/(13[0-9][0-9]|14[0-9][0-9])\/(0[1-9]|1[0-2])\/(0[1-9]|1[0-9]|2[0-9]|3[0-1])$/'],
            'load_id' => 'required',
            'products_data' => ['required', Rule::notIn(['[]']),],
            'do_price' => 'integer|min:0',
            'hire' => 'integer|min:0',
            'discharge' => 'integer|min:0',
            'weighbridge' => 'integer|min:0',
            'handy' => 'integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'load_id.required' => 'یک رسید بار رانتخاب کنید',

            'date.required' => 'تاریخ الزامیست',
            'date.regex' => 'فرمت تاریخ اشتباه است',

            'products_data.required' => 'محصولی وارد نشده است',
            'products_data.not_in' => 'محصولی وارد نشده است',

            'do_price.integer' => 'مقدار مبلغ حق العمل صحیح نمی باشد',
            'do_price.min' => 'مقدار مبلغ حق العمل نمیتواند منفی باشد',

            'hire.integer' => 'مقدار مبلغ تخلیه صحیح نمی باشد',
            'hire.min' => 'مقدار مبلغ  تخلیه نمیتواند منفی باشد',

            'discharge.integer' => 'مقدار مبلغ باسکول صحیح نمی باشد',
            'discharge.min' => 'مقدار مبلغ باسکول نمیتواند منفی باشد',

            'weighbridge.integer' => 'مقدار مبلغ پرداختی صحیح نمی باشد',
            'weighbridge.min' => 'مقدار مبلغ وارده نمیتواند منفی باشد',

            'handy.integer' => 'مقدار مبلغ دستی صحیح نمی باشد',
            'handy.min' => 'مقدار مبلغ دستی نمیتواند منفی باشد',
        ];
    }
}
