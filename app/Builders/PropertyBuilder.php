<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\PropertyData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
final class PropertyBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function whereFeatured(): self
    {
        return $this->where('is_featured', true);
    }

    /**
     * @return self<TModel>
     */
    public function featured(): self
    {
        return $this->with('defaultImage:id,path,property_id')
            ->whereFeatured();
    }

    /**
     * @return self<TModel>
     */
    public function search(PropertyData $data): self
    {
        return $this->with('defaultImage:id,path,property_id')
            ->when($data->isNotNull('search'), function (self $query) use ($data): self {
                $search = "%$data->search%";

                return $query->where(function (self $query) use ($search): self {
                    return $query->whereLike('title', $search)
                        ->orWhereLike('caption', $search);
                });
            })->when(
                $data->isNotNull('location'),
                fn (self $query): self => $query->where('location', $data->location),
            )->when(
                $data->isNotNull('type'),
                fn (self $query): self => $query->where('type', $data->type),
            )->when(
                $data->isNotNull('price'),
                function (self $query) use ($data): self {
                    $price = $data->getPrice();

                    return $query->where('price', '>=', $price->first())
                        ->when(
                            $price->count() > 1,
                            fn (self $builder): self => $builder->where('price', '<=', $price->last())
                        );
                },
            )->when(
                $data->isNotNull('area'),
                function (self $query) use ($data): self {
                    $area = $data->getArea();

                    return $query->where('area', '>=', $area->first())
                        ->when(
                            $area->count() > 1,
                            fn (self $builder): self => $builder->where('area', '<=', $area->last())
                        );
                },
            )->when(
                $data->isNotNull('isFeatured'),
                fn (self $query): self => $query->where('is_featured', $data->isFeatured),
            );
    }
}
