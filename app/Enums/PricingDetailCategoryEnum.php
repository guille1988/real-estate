<?php

declare(strict_types=1);

namespace App\Enums;

enum PricingDetailCategoryEnum: string
{
    case ADDITIONAL_FEES = 'additional_fees';
    case MONTHLY_COSTS = 'monthly_costs';
    case TOTAL_INITIAL_COSTS = 'total_initial_costs';
    case MONTHLY_EXPENSES = 'monthly_expenses';

    public function title(): string
    {
        return str($this->value)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }
}
