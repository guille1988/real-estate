<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Throwable;

/** @mixin Property */
final class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     *
     * @throws Throwable
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'caption' => $this->caption,
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'bathrooms' => $this->bathrooms,
            'bedrooms' => $this->bedrooms,
            'price' => $this->getDollarPrice(),
            'area' => $this->area,
            'images' => $this->images->toResourceCollection(),
            'amenities' => $this->amenities->toResourceCollection(),
        ];
    }
}
