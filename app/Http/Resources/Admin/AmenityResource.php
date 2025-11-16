<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Amenity */
final class AmenityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $description = str($this->description)
            ->limit(limit: 48, preserveWords: true)
            ->toString();

        return [
            'uuid' => $this->uuid,
            'description' => $description,
            'property_title' => $this->property?->title,
            'property_default_image' => $this->property?->getDefaultImage(),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
