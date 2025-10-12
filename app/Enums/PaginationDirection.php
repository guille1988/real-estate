<?php

declare(strict_types=1);

namespace App\Enums;

enum PaginationDirection: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}
