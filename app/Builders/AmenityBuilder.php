<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\AmenityIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
final class AmenityBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function forIndexing(AmenityIndexData $data): self
    {
        return $this->with('property', function (Relation $query): void {
            $query->select(['id', 'uuid', 'title'])
                ->with(['defaultImage:id,path,property_id']);
        })->when($data->isNotNull('search'), function (self $query) use ($data): void {
            $query->whereLike('description', "%$data->search%");
        })->orderBy($data->getSort(), $data->getDirection());
    }
}
