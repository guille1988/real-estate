<?php

declare(strict_types=1);

namespace App\Builders;

use App\Data\Admin\ImageData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
final class ImageBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function whereDefault(): self
    {
        return $this->where('is_default', true);
    }

    /**
     * @return self<TModel>
     */
    public function forIndexing(ImageData $data): self
    {
        $columns = [
            'id',
            'uuid',
            'path',
            'is_default',
            'property_id',
        ];

        return $this->with('property:id,title')
            ->select($columns)
            ->when($data->isNotNull('search'), function (self $query) use ($data): void {
                $query->whereRelation('property', 'title', 'like', "%$data->search%");
            })->when($data->isNotNull('path'), function (self $query) use ($data): void {
                $query->whereLike('path', "%$data->path%");
            })->when($data->isNotNull('isDefault'), function (self $query) use ($data): void {
                $query->where('is_default', $data->isDefault);
            })->orderBy($data->getSort(), $data->getDirection());
    }
}
