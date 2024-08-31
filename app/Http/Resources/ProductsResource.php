<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'price_full_design' => $this->price_full_design,
            'sales_count' => $this->sales_count,
            'views_count' => $this->views_count,
            'front_image' => url(Storage::url('products/'.$this->front_image)),
            'back_image' => url(Storage::url('products/'.$this->back_image)),
            'diamonds' => $this->diamonds,


            'mobile_back_image' => url(Storage::url('products/'.$this->mobile_back_image)),
            'mobile_back_tint' => url(Storage::url('products/'.$this->mobile_back_tint)),
            'mobile_back_shadow' => url(Storage::url('products/'.$this->mobile_back_shadow)),
            'mobile_back_image_width' => $this->mobile_back_image_width,
            'mobile_back_image_height' => $this->mobile_back_image_height,
            'mobile_back_width' => $this->mobile_back_width,
            'mobile_back_height' => $this->mobile_back_height,
            'mobile_back_left' => $this->mobile_back_left,
            'mobile_back_top' => $this->mobile_back_top,

            'mobile_front_image' => url(Storage::url('products/'.$this->mobile_front_image)),
            'mobile_front_tint' => url(Storage::url('products/'.$this->mobile_front_tint)),
            'mobile_front_shadow' => url(Storage::url('products/'.$this->mobile_front_shadow)),
            'mobile_front_image_width' => $this->mobile_front_image_width,
            'mobile_front_image_height' => $this->mobile_front_image_height,
            'mobile_front_width' => $this->mobile_front_width,
            'mobile_front_height' => $this->mobile_front_height,
            'mobile_front_left' => $this->mobile_front_left,
            'mobile_front_top' => $this->mobile_front_top,

            'user' => $this->user ? AuthResource::make($this->user) : null,
            'variations' => $this->variations ? VariationsResource::collection($this->variations->unique('color_id')) : null,
            'images' => $this->images ? imagesResource::collection($this->images) : null,
        ];
    }
}
