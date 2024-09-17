<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DayResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number
        ];
    }
}
