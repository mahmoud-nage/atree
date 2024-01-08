<?php

namespace App\Http\Requests\Dashboard\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'image' => 'nullable|image' , 
            'name.en' => 'required|unique:categories,name->en' ,
            'name.ar' => 'required|unique:categories,name->ar' , 
            'category_id' => 'nullable' ,
            'show_in_header' => 'nullable' , 
            'show_in_home_page' => 'nullable' , 
            'show_after_slider' => 'nullable' , 
        ];
    }
}
