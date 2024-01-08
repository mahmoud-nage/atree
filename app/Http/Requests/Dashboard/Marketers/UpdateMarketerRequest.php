<?php

namespace App\Http\Requests\Dashboard\Marketers;

use Illuminate\Foundation\Http\FormRequest;
use Request;
class UpdateMarketerRequest extends FormRequest
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
        $id = Request::segment(4);
        return [
            'name' => 'required' , 
            'email' => 'required|email|unique:users,email,'.$id , 
            'phone' => 'required|unique:users,email,'.$id , 
            'image' => 'nullable|image' , 
        ];
    }
}
