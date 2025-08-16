<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\FaqItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin FaqItem */
final class FaqItemResource extends JsonResource
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
            'subtitle' => $this->subtitle,
            'paragraphs' => $this->paragraphs,
        ];
    }
}
