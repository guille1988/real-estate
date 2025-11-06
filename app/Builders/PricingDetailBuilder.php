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
                $query->whereLike('name', "%$data->search%");
            })->orderBy($data->getSort(), $data->getDirection());
    }
}
