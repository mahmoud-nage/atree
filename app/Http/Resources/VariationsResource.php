<?php

namespace App\Http\Resources;

use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VariationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $sizes = Variation::where('product_id', $this->product_id)->where('color_id', $this->color_id)->get();
        return [
            'id' => $this->id,
            'name' => $this->color->name,
            'code' => $this->color->code,
            'quantity' => $this->quantity,
            'sizes' => $sizes ? SizesResource::collection($sizes) : null,
        ];
    }
}
