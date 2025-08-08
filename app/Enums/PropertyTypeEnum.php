<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Trait\Responsable;
use App\Enums\Trait\Titleable;

enum PropertyTypeEnum: string
{
    use Responsable, Titleable;

    case APARTMENT = 'apartment';
    case HOUSE = 'house';
    case LOFT = 'loft';
    case VILLA = 'villa';
}
