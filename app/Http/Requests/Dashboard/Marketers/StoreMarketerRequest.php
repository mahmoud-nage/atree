<?php

namespace App\Http\Requests\Dashboard\Marketers;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarketerRequest extends FormRequest
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
            'name' => 'required' , 
            'email' => 'required|unique:users,email|email' , 
            'phone' => 'required|unique:users,phone' , 
            'password'=> 'required|min:8|confirmed' , 
            'image'=> 'nullable|image' , 
        ];
    }
}
