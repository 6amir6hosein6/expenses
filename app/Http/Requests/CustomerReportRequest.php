<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerReportRequest extends FormRequest
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
            'since' => ['required', 'regex:/(13[0-9][0-9]|14[0-9][0-9])\/(0[1-9]|1[0-2])\/(0[1-9]|1[0-9]|2[0-9]|3[0-1])$/'],
            'until' => ['required', 'regex:/(13[0-9][0-9]|14[0-9][0-9])\/(0[1-9]|1[0-2])\/(0[1-9]|1[0-9]|2[0-9]|3[0-1])$/'],

        ];
    }

    public function messages()
    {
        return [

            'customer_id.required' => 'لطفا یک مشتری انتخاب کنید',

            'since.required' => '"از تاریخ" را وارد کنید',
            'since.regex' => 'فرمت "از تاریخ" اشتباه است',

            'until.required' => '"تا تاریخ" را وارد کنید',
            'until.regex' => 'فرمت "تا تاریخ" اشتباه است',
        ];
    }
}
