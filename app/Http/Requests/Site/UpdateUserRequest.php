<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|unique:users,phone,' . auth()->id(),
            'username' => 'required|unique:users,username,' . auth()->id(),
            'password' => 'nullable|confirmed',
            'bio' => 'nullable',
            'image' => 'nullable|image',
            'banner' => 'nullable|image',
        ];
    }
}
