<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FishlogCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => FishlogResource::collection($this->collection),
        ];
    }
}