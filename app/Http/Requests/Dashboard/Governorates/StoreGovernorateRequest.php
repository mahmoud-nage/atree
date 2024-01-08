<?php

namespace App\Http\Requests\Dashboard\Governorates;

use Illuminate\Foundation\Http\FormRequest;

class StoreGovernorateRequest extends FormRequest
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
            'country_id' => 'required' ,  
            'shipping_cost' => 'required' , 
        ];
    }
}
