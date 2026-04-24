<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FishlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'fishlogs',
            'id' => (string) $this->id,

            'attributes' => [
                'date' => $this->date,
                'name' => $this->name,
                'location' => $this->location,
                'species' => $this->species,
                'method' => $this->method,
                'rating' => $this->rating,
            ],

            'relationships' => [
                'user_id' => $this->user_id,
                'tags' => $this->tags->pluck('name'),
                'photos' => $this->photos->pluck('id'),
            ],
        ];
    }
}