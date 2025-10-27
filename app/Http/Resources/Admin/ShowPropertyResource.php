<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

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
            'caption' => $this->caption,
            'description' => $this->description,
            'address' => $this->getFullAddress(),
            'type' => $this->type,
            'location' => $this->location->title(),
            'bathrooms' => $this->getBathroomWithLeftPad(),
            'bedrooms' => $this->getBedroomWithLeftPad(),
            'price' => $this->getDollarPrice(),
            'area' => $this->getAreaOnSquareFeet(),
            'isFeatured' => $this->is_featured ? 'Yes' : 'No',
            'createdAt' => $this->created_at?->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
