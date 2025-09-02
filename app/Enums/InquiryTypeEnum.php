<?php

declare(strict_types=1);

namespace App\Enums;

enum InquiryTypeEnum: string
{
    case BUY = 'buy';
    case SELL = 'sell';
    case RENT = 'rent';
    case OTHER = 'other';
}
