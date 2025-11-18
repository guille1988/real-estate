<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\PropertyMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PropertyMessage */
final class IndexPropertyMessageResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'bathrooms' => $this->bathrooms,
            'bedrooms' => $this->bedrooms,
            'property_type' => $this->property_type,
            'read_at' => $this->read_at?->toDateTimeString(),
        ];
    }
}
