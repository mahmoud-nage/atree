<?php

namespace App\Http\Requests\Dashboard\Shipping_companies;

use Illuminate\Foundation\Http\FormRequest;
use Request;
class UpdateShippingCompaniesRequest extends FormRequest
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
            'name_ar' => 'required|unique:colors,name->ar,'.$id,
            'name_en' => 'required|unique:colors,name->en,'.$id,
            'is_active' => 'nullable' ,
        ];
    }
}
