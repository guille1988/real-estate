<?php

declare(strict_types=1);

namespace App\Collections;

use App\Models\PricingDetail;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

/**
 * @template-extends EloquentCollection<int, PricingDetail>
 */
final class PricingDetailCollection extends EloquentCollection
{
    /**
     * @return Collection<int, array{category: string, details: ResourceCollection}>
     */
    public function groupedByCategory(): Collection
    {
        /** @var Collection<string, PricingDetailCollection> $grouped */
        $grouped = $this->groupBy->categoryTitle();

        return $grouped->map(fn (self $pricingDetails, string $category): array => [
            'category' => $category,
            'details' => $pricingDetails->toResourceCollection(),
        ])->values();
    }
}
