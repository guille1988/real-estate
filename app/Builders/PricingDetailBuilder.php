<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\PricingDetailIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
final class PricingDetailBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function forIndexing(PricingDetailIndexData $data): self
    {
        return $this->with('property.defaultImage:id,path,property_id')
            ->when($data->isNotNull('search'), function (self $query) use ($data): void {
                $search = "%$data->search%";

                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->whereLike('name', $search)
                        ->orWhereLike('description', $search);
                });
            })->when($data->isNotNull('property'), function (self $query) use ($data): void {
                $query->whereRelation('property', 'uuid', $data->property);
            })->when($data->isNotNull('category'), function (self $query) use ($data): void {
                $query->where('category', $data->category);
            })->orderBy($data->getSort(), $data->getDirection());
    }
}
