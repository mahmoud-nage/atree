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
        $validate = [
            'product_id' => 'required|array',
            'products.*' => 'nullable|exists:products,id'
        ];

        if (request()->type == 1) {
            $validate['color_id.*'] = 'required|exists:colors,id';
            $validate['size_id.*'] = 'required|exists:sizes,id';
            $validate['quantities.*'] = 'required|numeric|min:1';
        }
        return $validate;

    }
}
