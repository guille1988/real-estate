<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum PropertyBudgetEnum: string
{
    case UNDER_100_000 = 'under-100000';
    case BETWEEN_100_000_AND_250_000 = '100000-250000';
    case BETWEEN_250_000_AND_500_000 = '250000-500000';
    case BETWEEN_500_000_AND_750_000 = '500000-750000';
    case BETWEEN_750_000_AND_1_000_000 = '750000-1000000';
    case MORE_THAN_1_000_000 = '1000000-plus';

    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response version of all property budgets.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->map(fn (self $propertyBudget): array => [
                'label' => $propertyBudget->getLabel(),
                'value' => $propertyBudget->value,
            ]);
    }

    /*
     * Returns the label version of the budget value.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::UNDER_100_000 => 'Under $100,000',
            self::BETWEEN_100_000_AND_250_000 => '$100,000 - $250,000',
            self::BETWEEN_250_000_AND_500_000 => '$250,000 - $500,000',
            self::BETWEEN_500_000_AND_750_000 => '$500,000 - $750,000',
            self::BETWEEN_750_000_AND_1_000_000 => '$750,000 - $1,000,000',
            self::MORE_THAN_1_000_000 => 'More than $1,000,000',
        };
    }
}
