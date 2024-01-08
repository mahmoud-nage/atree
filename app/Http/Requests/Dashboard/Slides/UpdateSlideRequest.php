<?php

namespace App\Http\Requests\Dashboard\Slides;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlideRequest extends FormRequest
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
            'link' => 'nullable' , 
            'image' => 'nullable' ,
            'active' => 'nullable' , 
        ];
    }
}
