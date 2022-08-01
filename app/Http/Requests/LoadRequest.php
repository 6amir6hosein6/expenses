<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoadRequest extends FormRequest
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
            'owner_name' => 'required',
            'owner_id' => 'integer',
            'description' => 'required',
            'date' =>  ['required', 'regex:/(13[0-9][0-9]|14[0-9][0-9])\/(0[1-9]|1[0-2])\/(0[1-9]|1[0-9]|2[0-9]|3[0-1])$/'],
        ];
    }

    public function messages()
    {
        return [

            'owner_name.required' => 'لطفا یک مشتری انتخاب کنید',
            'description.required' => 'لطفا شرح بار را وارد کنید',
            'date.required' => 'لطفا تاریخ را وارد کنید',

            'owner_id.integer' => 'بارکد مشتری باید عدد باشد',
            'date.regex' => 'فرمت تاریخ اشتباه هست . نحوه صحیح : ۱۴۰۰/۰۱/۰۶'
        ];
    }
}
