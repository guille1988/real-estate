<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ContactMessage */
final class IndexContactMessageResource extends JsonResource
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
            'phone' => $this->phone,
            'inquiry_type' => $this->inquiry_type,
            'source' => $this->source,
            'read_at' => $this->read_at?->toDateTimeString(),
        ];
    }
}
