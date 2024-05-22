<?php

namespace App\Http\Requests\Dashboard\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUserRequest extends FormRequest
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
            'phone' => 'required|unique:users,phone,'.$id ,
            'name' => 'required' ,
            'password' => 'nullable|min:8|confirmed' ,
            'active' => 'nullable' ,
            'image' => 'nullable|image' ,
        ];
    }
}
