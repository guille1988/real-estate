<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Throwable;

/** @mixin Property */
final class ShowPropertyResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'address' => $this->getFullAddress(),
            'type' => $this->type,
            'bathrooms' => $this->getBathroomWithLeftPad(),
            'bedrooms' => $this->getBedroomWithLeftPad(),
            'price' => $this->getDollarPrice(),
            'area' => $this->getAreaOnSquareFeet(),
            'images' => $this->images->toResourceCollection(),
            'amenities' => $this->amenities->toResourceCollection(),
            'pricing_details' => $this->pricingDetails->groupedByCategory(),
        ];
    }
}
