<?php

declare(strict_types=1);

namespace App\Enums;

enum ChangeTypeEnum: string
{
    case INCREASE = 'increase';
    case DECREASE = 'decrease';
}
