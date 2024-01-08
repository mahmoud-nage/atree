<?php

namespace App\Http\Requests\Dashboard\Coupons;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'code' => 'required|unique:coupons,code',
            'start_date' => 'nullable|date' , 
            'end_date' => 'nullable|date' , 
            'allowed_more_than_once_per_user' => 'nullable' , 
            'active' => 'nullable' , 
            'discount' => 'required'  , 
            'allow_times' => 'nullable' , 
        ];
    }
}
