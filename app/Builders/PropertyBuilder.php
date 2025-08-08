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
            ->when($data->isNotEmpty('search'), function (self $query) use ($data): self {
                $search = "%$data->search%";

                return $query->whereLike('title', $search)
                    ->orWhereLike('caption', $search);
            })
            ->when(
                $data->isNotEmpty('type'),
                fn (self $query): self => $query->where('type', $data->type),
            )
            ->when(
                $data->isNotEmpty('location'),
                fn (self $query): self => $query->where('location', $data->location),
            )
            ->when(
                $data->isNotEmpty('isFeatured'),
                fn (self $query): self => $query->where('is_featured', $data->isFeatured),
            );
    }
}
