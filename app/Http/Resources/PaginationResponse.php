<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'current_page' => $this['meta']['current_page'],
            'last_page' => $this['meta']['last_page'],
            'total' => $this['meta']['total'],
            'per_page' => $this['meta']['per_page'],
        ];
    }
}
