<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\PropertyMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PropertyMessage */
final class ShowPropertyMessageResource extends JsonResource
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
            'message' => $this->getMessage(),
            'read_at' => $this->read_at?->toDateTimeString(),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
