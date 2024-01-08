<?php

namespace App\Http\Requests\Dashboard\Challenges;

use Illuminate\Foundation\Http\FormRequest;

class StoreChallengeRequest extends FormRequest
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
            'title' => 'required' , 
            'orders' => 'required' , 
            'money' => 'required' , 
            'color' => 'required' , 
            'starts_at' => 'nullable' , 
            'ends_at' => 'nullable' , 
            'is_active' => 'nullable' , 
            'should_user_finishes_to_receive_money' => 'nullable' , 
        ];
    }
}
