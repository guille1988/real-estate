<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Inquiry */
final class IndexInquiryResource extends JsonResource
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
            'read_at' => $this->read_at?->toDateTimeString(),
            'property_title' => $this->property?->title,
            'property_default_image' => $this->property?->getDefaultImage(),
        ];
    }
}
