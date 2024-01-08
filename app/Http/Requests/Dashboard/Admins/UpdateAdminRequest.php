<?php

namespace App\Http\Requests\Dashboard\Admins;

use Illuminate\Foundation\Http\FormRequest;
use Request;
class UpdateAdminRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$id , 
            'name' => 'required' , 
            'password' => 'nullable|min:8|confirmed' , 
            'image' => 'nullable|image' , 
        ];
    }
}
