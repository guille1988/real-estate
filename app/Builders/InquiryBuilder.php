<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\InquiryIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
final class InquiryBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function forIndexing(InquiryIndexData $data): self
    {
        return $this->with('property:id,title')
            ->when($data->isNotNull('search'), function (self $query) use ($data): void {
                $search = "%$data->search%";

                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->whereLike('first_name', $search)
                        ->orWhereLike('last_name', $search)
                        ->orWhereLike('email', $search)
                        ->orWhereLike('phone', $search);
                });
            })->orderBy($data->getSort(), $data->getDirection());
    }
}
