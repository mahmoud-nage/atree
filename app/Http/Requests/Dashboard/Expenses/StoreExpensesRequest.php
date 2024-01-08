<?php

namespace App\Http\Requests\Dashboard\Expenses;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpensesRequest extends FormRequest
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
            'category_id' => 'required' , 
            'details' => 'nullable' , 
            'image' => 'nullable' , 
            'money' => 'required'
        ];
    }
}
