<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Image */
final class IndexImageResource extends JsonResource
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
            'property' => $this->property?->title,
            'type' => $this->path,
            'is_default' => $this->is_default,
        ];
    }
}
