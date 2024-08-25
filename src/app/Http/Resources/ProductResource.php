<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'identifier' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'expiration_date' => Carbon::parse($this->expiration_date)->format('d/m/Y'),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i'),
        ];
    }
}
