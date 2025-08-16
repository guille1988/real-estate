<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Testimonial */
final class TestimonialResource extends JsonResource
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
            'thumbnail' => $this->getUrl(),
            'location' => $this->location,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
