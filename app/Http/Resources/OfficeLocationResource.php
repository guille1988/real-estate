<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\OfficeLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin OfficeLocation */
final class OfficeLocationResource extends JsonResource
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
            'email' => $this->email,
            'type' => $this->type,
            'title' => $this->title,
            'address' => $this->address,
            'description' => $this->description,
            'phone' => $this->phone,
            'location' => $this->location,
            'url' => $this->url,
        ];
    }
}
