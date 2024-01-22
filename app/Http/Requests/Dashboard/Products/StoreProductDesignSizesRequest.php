<?php

namespace App\Http\Requests\Dashboard\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductDesignSizesRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'site_back_width' => 'nullable',
            'site_back_height' => 'nullable',
            'site_back_left' => 'nullable',
            'site_back_top' => 'nullable',
            'site_front_width' => 'nullable',
            'site_front_height' => 'nullable',
            'site_front_left' => 'nullable',
            'site_front_top' => 'nullable',
            'mobile_back_image_width' => 'nullable',
            'mobile_back_image_height' => 'nullable',
            'mobile_back_width' => 'nullable',
            'mobile_back_height' => 'nullable',
            'mobile_back_left' => 'nullable',
            'mobile_back_top' => 'nullable',
            'mobile_front_image_width' => 'nullable',
            'mobile_front_image_height' => 'nullable',
            'mobile_front_width' => 'nullable',
            'mobile_front_height' => 'nullable',
            'mobile_front_left' => 'nullable',
            'mobile_front_top' => 'nullable',
        ];
    }
}
