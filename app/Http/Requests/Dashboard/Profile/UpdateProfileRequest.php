<?php

namespace App\Http\Requests\Dashboard\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UpdateProfileRequest extends FormRequest
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
        $id = Auth::id();
        return [
            'name' => 'required' , 
            'image' => 'nullable|image' , 
            'phone' => 'nullable|unique:users,phone,'.$id , 
            'email' => 'required|email|unique:users,email,'.$id , 
        ];
    }
}
