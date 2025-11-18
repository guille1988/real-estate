<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\PropertyMessageIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
final class PropertyMessageBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function forIndexing(PropertyMessageIndexData $data): self
    {
        $columns = [
            'id',
            'uuid',
            'first_name',
            'last_name',
            'email',
            'bathrooms',
            'bedrooms',
            'property_type',
            'read_at',
        ];

        return $this->select($columns)
            ->when($data->isNotNull('search'), function (self $query) use ($data): void {
                $search = "%$data->search%";

                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->whereLike('first_name', $search)
                        ->orWhereLike('last_name', $search)
                        ->orWhereLike('email', $search);
                });
            })->orderBy($data->getSort(), $data->getDirection());
    }
}
