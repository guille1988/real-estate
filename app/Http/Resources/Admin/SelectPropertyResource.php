<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Property */
final class SelectPropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'label' => $this->title,
            'value' => $this->uuid,
        ];
    }
}
