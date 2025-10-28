<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Property */
final class IndexPropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'type' => $this->type,
            'bathrooms' => $this->bathrooms,
            'bedrooms' => $this->bedrooms,
            'is_featured' => $this->is_featured,
            'price' => $this->getDollarPrice(),
            'image' => $this->getDefaultImage(),
        ];
    }
}
