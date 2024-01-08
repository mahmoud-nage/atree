<?php

namespace App\Http\Requests\Dashboard\Branches;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
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
            'address' => 'nullable' , 
            'phone1' => 'nullable' , 
            'phone2' => 'nullable' , 
            'mobile' => 'nullable' , 
            'fax' => 'nullable' , 
            'commercial_registration' => 'nullable' , 
            'show_address' => 'nullable' , 
            'show_phone1' => 'nullable' , 
            'show_phone2' => 'nullable' , 
            'show_mobile' => 'nullable' , 
            'show_fax' => 'nullable' , 
            'show_commercial_registration' => 'nullable' , 
            'warehouses' => 'array|nullable'
        ];
    }
}
