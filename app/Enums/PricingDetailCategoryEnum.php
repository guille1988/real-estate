<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum PricingDetailCategoryEnum: string
{
    case ADDITIONAL_FEES = 'additional_fees';
    case MONTHLY_COSTS = 'monthly_costs';
    case TOTAL_INITIAL_COSTS = 'total_initial_costs';
    case MONTHLY_EXPENSES = 'monthly_expenses';

    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response version of all categories.
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
     * Returns true if the pricing detail category
     * is the same as the given category.
     */
    public function equalsTo(self $category): bool
    {
        return $this->value === $category->value;
    }

    /*
     * Returns true if the pricing detail category
     * is different from the given category.
     */
    public function isNotEqualTo(self $category): bool
    {
        return ! $this->equalsTo($category);
    }

    /*
     * Returns the special price for the pricing detail category.
     */
    public function getSpecialPrice(): string
    {
        return match ($this) {
            self::ADDITIONAL_FEES => 'Varies',
            self::MONTHLY_EXPENSES => 'If Applicable',
            default => 'N/A'
        };
    }

    /*
     * Returns the title version of the pricing detail category value.
     */
    public function title(): string
    {
        return str($this->value)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }
}
