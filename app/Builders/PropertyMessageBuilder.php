<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\PropertyMessageIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Stringable;

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
            'budget',
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
            })->when($data->isNotNull('propertyType'), function (self $query) use ($data): void {
                $query->where('property_type', $data->propertyType);
            })->when($data->isNotNull('budget'), function (self $query) use ($data): void {
                $query->where('budget', $data->budget);
            })->when($data->isNotNull('read'), function (self $query) use ($data): void {
                $stringQuery = str('where')
                    ->when($data->read, fn (Stringable $stringable): Stringable => $stringable->append('Not'))
                    ->append('Null')
                    ->toString();

                $query->$stringQuery('read_at');
            })->orderBy($data->getSort(), $data->getDirection());
    }

    /**
     * @return self<TModel>
     */
    public function lastTwelveMonths(): self
    {
        $end = now()->endOfMonth();
        $start = $end->subMonths(11)->startOfMonth();

        return $this->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('month')
            ->orderBy('month');
    }
}
