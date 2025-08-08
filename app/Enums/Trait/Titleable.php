<?php

declare(strict_types=1);

namespace App\Enums\Trait;

trait Titleable
{
    /*
     * Returns the title of the enum value.
     */
    public function title(): string
    {
        return str($this->value)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }
}
