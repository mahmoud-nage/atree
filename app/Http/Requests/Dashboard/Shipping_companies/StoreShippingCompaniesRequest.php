<?php

namespace App\Http\Requests\Dashboard\Shipping_companies;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingCompaniesRequest extends FormRequest
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
            'name_ar' => 'required|unique:colors,name->ar',
            'name_en' => 'required|unique:colors,name->en',
            'is_active' => 'nullable' ,
        ];
    }
}
