<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
//            'product_id' => 'required|exists:products,id',
//            'color_id.*' => 'required|exists:colors,id',
//            'size_id.*' => 'required|exists:sizes,id',
//            'quantities.*' => 'required|numeric|min:1'
        ];
    }
}
