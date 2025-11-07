<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\PricingDetailIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        $columns = [
            'id',
            'uuid',
            'name',
            'price',
            'category',
            'property_id',
        ];

        return $this->with('property', function (Relation $query): void {
            $query->select(['id', 'uuid', 'title'])
                ->with(['defaultImage:id,path,property_id']);
        })->select($columns)
            ->when($data->isNotNull('search'), function (self $query) use ($data): void {
                $search = "%$data->search%";

                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->whereLike('name', $search)
                        ->orWhereRelation('property', 'title', 'like', $search);
                });
            })->when($data->isNotNull('category'), function (self $query) use ($data): void {
                $query->where('category', $data->category);
            })->orderBy($data->getSort(), $data->getDirection());
    }
}
