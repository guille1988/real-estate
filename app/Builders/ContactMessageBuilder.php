<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\ContactIndexData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Stringable;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
final class ContactMessageBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function forIndexing(ContactIndexData $data): self
    {
        $columns = [
            'id',
            'uuid',
            'first_name',
            'last_name',
            'email',
            'phone',
            'inquiry_type',
            'source',
            'read_at',
        ];

        return $this->select($columns)
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
            })->when($data->isNotNull('inquiryType'), function (self $query) use ($data): void {
                $query->where('inquiry_type', $data->inquiryType);
            })->when($data->isNotNull('source'), function (self $query) use ($data): void {
                $query->where('source', $data->source);
            })->orderBy($data->getSort(), $data->getDirection());
    }
}
