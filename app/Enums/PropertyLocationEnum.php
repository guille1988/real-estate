<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Trait\Responsable;
use App\Enums\Trait\Titleable;

enum PropertyLocationEnum: string
{
    use Responsable, Titleable;

    case AUSTIN = 'austin';
    case CHARLOTTE = 'charlotte';
    case CHICAGO = 'chicago';
    case COLUMBUS = 'columbus';
    case DALLAS = 'dallas';
    case DENVER = 'denver';
    case FORT_WORTH = 'fort_worth';
    case HOUSTON = 'houston';
    case INDIANAPOLIS = 'indianapolis';
    case JACKSONVILLE = 'jacksonville';
    case LOS_ANGELES = 'los_angeles';
    case MIAMI = 'miami';
    case NEW_YORK = 'new_york';
    case PHILADELPHIA = 'philadelphia';
    case PHOENIX = 'phoenix';
    case SAN_DIEGO = 'san_diego';
    case SAN_FRANCISCO = 'san_francisco';
    case SAN_JOSE = 'san_jose';
    case SEATTLE = 'seattle';
    case WASHINGTON = 'washington';
}
