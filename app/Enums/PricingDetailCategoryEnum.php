<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Trait\Titleable;

enum PricingDetailCategoryEnum: string
{
    use Titleable;

    case ADDITIONAL_FEES = 'additional_fees';
    case MONTHLY_COSTS = 'monthly_costs';
    case TOTAL_INITIAL_COSTS = 'total_initial_costs';
    case MONTHLY_EXPENSES = 'monthly_expenses';

    public function getSpecialPrice(): string
    {
        return match ($this) {
            self::ADDITIONAL_FEES => 'Varies',
            self::MONTHLY_EXPENSES => 'If Applicable',
            default => 'N/A'
        };
    }
}
