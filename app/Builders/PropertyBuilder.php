<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\PropertyData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
        $columns = [
            'id',
            'uuid',
            'caption',
            'title',
            'description',
            'type',
            'bathrooms',
            'bedrooms',
            'price',
        ];

        return $this->select($columns)
            ->with('defaultImage:id,path,property_id')
            ->when($data->isNotNull('search'), function (self $query) use ($data): void {
                $search = "%$data->search%";

                $query->where(function (self $subQuery) use ($search): void {
                    $subQuery->whereLike('title', $search)
                        ->orWhereLike('caption', $search);
                });
            })->when($data->isNotNull('location'), function (self $query) use ($data): void {
                $query->where('location', $data->location);
            })->when($data->isNotNull('type'), function (self $query) use ($data): void {
                $query->where('type', $data->type);
            })->when(
                $data->isNotNull('price'),
                function (self $query) use ($data): void {
                    /**
                     * @var Collection<int, int<min, -1>|int<1, max>> $price
                     */
                    $price = $data->getPrice();

                    $query->where('price', '>=', $price->first())
                        ->when($price->count() > 1, function (self $subQuery) use ($price): void {
                            $subQuery->where('price', '<=', $price->last());
                        });
                },
            )->when(
                $data->isNotNull('area'),
                function (self $query) use ($data): void {
                    /**
                     * @var Collection<int, int<min, -1>|int<1, max>> $area
                     */
                    $area = $data->getArea();

                    $query->where('area', '>=', $area->first())
                        ->when($area->count() > 1, function (self $subQuery) use ($area): void {
                            $subQuery->where('area', '<=', $area->last());
                        }
                        );
                },
            )->when($data->isNotNull('isFeatured'), function (self $query) use ($data): void {
                $query->where('is_featured', $data->isFeatured);
            });
    }
}
