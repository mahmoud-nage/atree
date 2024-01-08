<?php

namespace App\Http\Requests\Dashboard\Brands;

use Illuminate\Foundation\Http\FormRequest;
use Request;
class UpdateBrandRequest extends FormRequest
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
            'name.en' => 'required|unique:brands,name->en,'.$id , 
            'name.ar' => 'required|unique:brands,name->ar,'.$id , 
            'logo' => 'nullable|image' ,
        ];
    }
}
