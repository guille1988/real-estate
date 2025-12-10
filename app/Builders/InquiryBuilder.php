<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\InquiryIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Stringable;

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
        $start = $end->copy()->subMonths(11)->startOfMonth();

        return $this->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as period, COUNT(*) as total")
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('period')
            ->orderBy('period');
    }
}
