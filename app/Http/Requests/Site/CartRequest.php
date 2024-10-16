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
            'products' => 'required|array',
            'products.*' => 'required|exists:products,id'
        ];

        if (request()->submit_type == 1 || request()->type == 'design') {
            $validate['color_id.*'] = 'required|exists:colors,id';
            $validate['size_id.*'] = 'required|exists:sizes,id';
            $validate['quantities.*'] = 'required|numeric|min:1';
        }
        if (request()->type == 'design') {
            $validate['design_id'] = 'required|exists:user_designs,id';
        }
        return $validate;

    }
    public function messages()
    {
        return [
            'products.*.exists' => __('validation.exists', ['attribute' => __('site.product')]),
            'products.*.required' =>  __('validation.required', ['attribute' => __('site.product')]),
            'size_id.*.exists' =>  __('validation.exists', ['attribute' => __('site.sizes')]),
            'size_id.*.required' => __('validation.required', ['attribute' => __('site.sizes')]),
            'color_id.*.exists' => __('validation.exists', ['attribute' => __('site.colors')]),
            'color_id.*.required' => __('validation.required', ['attribute' => __('site.colors')]),
            'quantities.*.required' => __('validation.required', ['attribute' => __('site.quantity')]),
            'quantities.*.exists' => __('validation.exists', ['attribute' => __('site.quantity')]),
            'quantities.*.min' => __('validation.min', ['attribute' => __('site.quantity')]),
            'quantities.*.numeric' => __('validation.numeric', ['attribute' => __('site.quantity')]),
        ];
    }

}
