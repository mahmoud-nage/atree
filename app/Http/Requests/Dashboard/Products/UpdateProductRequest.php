<?php

namespace App\Http\Requests\Dashboard\Products;

use Illuminate\Foundation\Http\FormRequest;
class UpdateProductRequest extends FormRequest
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
            'name_ar' => 'required', 
            'name_en' => 'required', 
            'description_ar' => 'nullable' ,  
            'description_en' => 'nullable' ,  
            'front_image' => 'nullable|image' , 
            'back_image' => 'nullable|image' , 
            'images' => 'nullable'  , 
            'images.*' => 'image' , 
            'price' => 'required' , 
            'price_full_design' => 'required' , 
            'diamonds' => 'required' , 
            'country_id' => 'required' , 
        ];
    }
}
