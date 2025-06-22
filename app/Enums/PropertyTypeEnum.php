<?php

declare(strict_types=1);

namespace App\Enums;

enum PropertyTypeEnum: string
{
    case HOUSE = 'house';
    case LOFT = 'loft';
    case VILLA = 'villa';
}
