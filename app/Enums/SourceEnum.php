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
     * @return Collection<string, string>
     *
     * Returns a collection of source types and their titles.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->flatMap(function (self $source): array {
                return [$source->value => $source->title()];
            });
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
