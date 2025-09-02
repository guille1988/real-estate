<?php

declare(strict_types=1);

namespace App\Enums;

enum SourceEnum: string
{
    case SEARCH = 'search';
    case SOCIAL = 'social';
    case REFERRAL = 'referral';
    case OTHER = 'other';
}
