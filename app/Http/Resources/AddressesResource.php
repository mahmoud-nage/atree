<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AddressesResource extends JsonResource
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
            'user' => $this->user ? LiteListResource::make($this->user) : null,
            'country' => $this->country ? LiteListResource::make($this->country) : null,
            'governorate' => $this->governorate ? LiteListResource::make($this->governorate) : null,
            'district' => $this->district,
            'building_number' => $this->building_number,
            'street_name' => $this->street_name,
            'is_default' => $this->is_default,
        ];
    }
}
