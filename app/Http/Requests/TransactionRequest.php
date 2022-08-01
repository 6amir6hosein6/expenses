<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
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
            'customer_id' => 'required',
            'date' => ['required', 'regex:/(13[0-9][0-9]|14[0-9][0-9])\/(0[1-9]|1[0-2])\/(0[1-9]|1[0-9]|2[0-9]|3[0-1])$/'],
            'price' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [

            'customer_id.required' => 'لطفا یک مشتری انتخاب کنید',

            'date.required' => 'تاریخ الزامیست',
            'date.regex' => 'فرمت تاریخ اشتباه است',

            'price.required' => 'لطفا مبلغ پرداختی را وارد کنید',
            'price.integer' => 'مقدار مبلغ پرداختی صحیح نمی باشد',
            'price.min' => 'مقدار مبلغ پرداختی نمی تواند صفر یا منفی باشد'
        ];
    }
}
