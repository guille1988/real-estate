<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
}
