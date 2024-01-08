<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class StoreComplainRequest extends FormRequest
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
        if (Auth::check()) {
            return [
            'type' => 'required' , 
            'category' => 'required' , 
            'content' => 'required'
            ];
        } else {
            return [
            'type' => 'required' , 
            'category' => 'required' , 
            'content' => 'required' , 
            'phone' => 'required' ,
            'email' => 'nullable|email' 
            ];
        }
    }
}
