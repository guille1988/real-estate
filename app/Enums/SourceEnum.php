<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum SourceEnum: string
{
    case SEARCH = 'search';
    case SOCIAL = 'social';
    case REFERRAL = 'referral';
    case OTHER = 'other';

    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response version of all sources.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->map(fn (self $source): array => [
                'label' => $source->title(),
                'value' => $source->value,
            ]);
    }

    /*
     * Returns the title version of the type value.
     */
    public function title(): string
    {
        return str($this->value)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }
}
