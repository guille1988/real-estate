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
final class UserBuilder extends Builder
{
    /**
     * @return self<TModel>
     */
    public function admin(bool $isAdmin = true): self
    {
        return $this->where('is_admin', $isAdmin);
    }
}
