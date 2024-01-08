<?php

namespace App\Http\Requests\Dashboard\BankAccounts;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankAccountRequest extends FormRequest
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
            'account_number' => 'required' , 
            'iban' => 'required' , 
            'mada_fees' => 'required' , 
            'visa_fees' => 'required' , 
        ];
    }
}
