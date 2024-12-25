<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class StoreWithdrawalRequest extends FormRequest
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
            'payment_method' => 'required|in:1,2' ,
            'bank_account_id' => 'required_without:bank_name|exists:bank_accounts,id',
            'phone' => 'required_if:payment_type,1',
            'bank_name' => 'required_without:bank_account_id',
            'name' => 'required_without:bank_account_id',
            'account_number' => 'required_without:bank_account_id',
            'iban' => 'nullable',
        ];
    }
}
