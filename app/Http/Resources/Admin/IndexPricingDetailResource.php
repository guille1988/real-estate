<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\PricingDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PricingDetail */
final class IndexPricingDetailResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->getDollarPrice(),
            'category' => $this->category,
            'property_title' => $this->property?->title,
            'property_default_image' => $this->property?->getDefaultImage(),
        ];
    }
}
