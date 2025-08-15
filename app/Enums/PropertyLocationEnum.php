<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum PropertyLocationEnum: string
{
    case AUSTIN = 'austin';
    case CHARLOTTE = 'charlotte';
    case CHICAGO = 'chicago';
    case COLUMBUS = 'columbus';
    case DALLAS = 'dallas';
    case DENVER = 'denver';
    case FORT_WORTH = 'fort_worth';
    case HOUSTON = 'houston';
    case INDIANAPOLIS = 'indianapolis';
    case JACKSONVILLE = 'jacksonville';
    case LOS_ANGELES = 'los_angeles';
    case MIAMI = 'miami';
    case NEW_YORK = 'new_york';
    case PHILADELPHIA = 'philadelphia';
    case PHOENIX = 'phoenix';
    case SAN_DIEGO = 'san_diego';
    case SAN_FRANCISCO = 'san_francisco';
    case SAN_JOSE = 'san_jose';
    case SEATTLE = 'seattle';
    case WASHINGTON = 'washington';

    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response version of all locations.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->map(fn (self $case): array => [
                'label' => $case->title(),
                'value' => $case->value,
            ]);
    }

    /*
     * Returns the title version of the location value.
     */
    public function title(): string
    {
        return str($this->value)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }
}
