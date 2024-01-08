<?php

namespace App\Http\Requests\Dashboard\Colors;

use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
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
            'code' => 'required',
            'is_active' => 'nullable' , 
        ];
    }
}
