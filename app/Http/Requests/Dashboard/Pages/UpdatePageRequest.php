<?php

namespace App\Http\Requests\Dashboard\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'title.en' => 'required' , 
            'title.ar' => 'required' , 
            'content.en' => 'required' , 
            'content.ar' => 'required' , 
            'active' => 'nullable' , 
            'slug' => 'required' , 
        ];
    }
}
