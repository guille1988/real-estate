<?php

declare(strict_types=1);

namespace App\Enums;

enum PricingDetailCategoryEnum: string
{
    case ADDITIONAL_FEES = 'additional_fees';
    case MONTHLY_COSTS = 'monthly_costs';
    case TOTAL_INITIAL_COSTS = 'total_initial_costs';
    case MONTHLY_EXPENSES = 'monthly_expenses';

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
