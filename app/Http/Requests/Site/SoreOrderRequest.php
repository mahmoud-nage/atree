<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class SoreOrderRequest extends FormRequest
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
            'payment_method_id' => 'required|exists:payment_methods,id' ,
            'address_id' => 'required|exists:user_addresses,id' ,
//            'city_id' => 'required|exists:cities,id' ,
            'coupon_id' => 'nullable|exists:coupons,id' ,
//            'address' => 'required',
//            'email' => 'required|email|email:dns',
//            'phone' => 'required' ,
//            'client_name' => 'required'
        ];
    }
}
