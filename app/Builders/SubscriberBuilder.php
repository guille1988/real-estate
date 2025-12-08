<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\SubscriberIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
final class SubscriberBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function forIndexing(SubscriberIndexData $data): self
    {
        return $this->when($data->isNotNull('search'), function (self $query) use ($data): void {
            $query->whereLike('email', "%$data->search%");
        })->orderBy($data->getSort(), $data->getDirection());
    }
}
