<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DesignsResource extends JsonResource
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
            'description' => $this->description,
            'main_color_code' => $this->main_color_code,
            'design_image_back' => url(Storage::url('designs/'.$this->design_image_back)),
            'design_image_front' => url(Storage::url('designs/'.$this->design_image_front)),
            'user' => $this->user ? AuthResource::make($this->user) : null,
            'product' => $this->product ? ProductsResource::make($this->product) : null,
        ];
    }
}
