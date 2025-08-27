<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Client */
final class ClientResource extends JsonResource
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
            'since' => $this->since,
            'url' => $this->url,
            'company' => $this->company,
            'domain' => $this->domain,
            'category' => $this->category,
            'opinion' => $this->opinion,
        ];
    }
}
