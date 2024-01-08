<?php

namespace App\Http\Requests\Dashboard\Cities;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            'name_ar' => 'required' , 
            'name_en' => 'required' , 
            'active' => 'nullable' , 
            'governorate_id' => 'required' , 
            'shipping_cost' => 'nullable'  , 
        ];
    }
}
