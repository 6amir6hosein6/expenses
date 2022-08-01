<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FactorRequest extends FormRequest
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
            'load_id' => 'required',
            'products_data' => ['required', Rule::notIn(['[]']),],
            'paid' => 'required|integer|min:0',
            'worker_paid' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [

            'customer_id.required' => 'لطفا یک مشتری انتخاب کنید',

            'load_id.required' => 'لطفا یک رسید بار اانتخاب کنید',

            'date.required' => 'تاریخ الزامیست',
            'date.regex' => 'فرمت تاریخ اشتباه است',

            'products_data.required' => 'محصولی وارد نشده است',
            'products_data.not_in' => 'محصولی وارد نشده است',

            'paid.required' => 'لطفا مبلغ پرداختی را وارد کنید',
            'paid.integer' => 'مقدار مبلغ پرداختی صحیح نمی باشد',
            'paid.min' => 'مقدار مبلغ پرداختی نمی تواند منفی باشد',

            'worker_paid.required' => 'لطفا هزینه کارگری را وارد کنید',
            'worker_paid.integer' => 'مقدار هزینه کارگری صحیح نمی باشد',
            'worker_paid.min' => 'مقدار هزینه کارگری نمی تواند منفی باشد'
        ];
    }
}
