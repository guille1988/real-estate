<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Enums\ChangeTypeEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class StatsData extends Data
{
    public function __construct(
        public string $name,
        public string $stat,
        public string $previousStat,
        public ?string $change,
        public ?ChangeTypeEnum $changeType
    ) {}
}
