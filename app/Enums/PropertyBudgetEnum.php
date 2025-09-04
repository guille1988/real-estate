<?php

declare(strict_types=1);

namespace App\Enums;

enum PropertyBudgetEnum: string
{
    case UNDER_100_000 = 'under-100000';
    case BETWEEN_100_000_AND_250_000 = '100000-250000';
    case BETWEEN_250_000_AND_500_000 = '250000-500000';
    case BETWEEN_500_000_AND_750_000 = '500000-750000';
    case BETWEEN_750_000_AND_1_000_000 = '750000-1000000';
    case MORE_THAN_1_000_000 = '1000000-plus';
}
