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
            })
            ->when(
                $data->isNotNull('type'),
                fn (self $query): self => $query->where('type', $data->type),
            )
            ->when(
                $data->isNotNull('location'),
                fn (self $query): self => $query->where('location', $data->location),
            )
            ->when(
                $data->isNotNull('isFeatured'),
                fn (self $query): self => $query->where('is_featured', $data->isFeatured),
            )->when(
                $data->isNotNull('price'),
                function (self $query) use ($data): self {
                    return $query->where('price', '>=', $data->price[0])
                        ->when(
                            count($data->price) > 1,
                            fn (self $builder): self => $builder->where('price', '<=', $data->price[1])
                        );
                },
            )->when(
                $data->isNotNull('area'),
                function (self $query) use ($data): self {
                    return $query->where('area', '>=', $data->area[0])
                        ->when(
                            count($data->area) > 1,
                            fn (self $builder): self => $builder->where('price', '<=', $data->area[1])
                        );
                },
            );
    }
}
