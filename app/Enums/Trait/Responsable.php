<?php

declare(strict_types=1);

namespace App\Enums\Trait;

use Illuminate\Support\Collection;

trait Responsable
{
    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response of all the cases of the enum.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->map(fn (self $location): array => [
                'label' => $location->title(),
                'value' => $location->value,
            ]);
    }
}
