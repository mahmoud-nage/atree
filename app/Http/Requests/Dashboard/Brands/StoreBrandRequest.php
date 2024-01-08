<?php

namespace App\Http\Requests\Dashboard\Brands;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name.en' => 'required|unique:brands,name->en' , 
            'name.ar' => 'required|unique:brands,name->ar' , 
            'logo' => 'required|image' ,
            'active' => 'nullable' ,
        ];
    }
}
