<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\StatsData;
use App\Enums\ChangeTypeEnum;

final readonly class GetStats
{
    public function __construct(private GetSubscribersStats $getSubscribersStats) {}

    public function execute(): array
    {
        /**
         * @var array<int, StatsData> $data
         */
        $rawData = [
            $this->getSubscribersStats->execute(),
        ];

        /**
         * @var array<int, array<string, string|ChangeTypeEnum>> $data
         */
        $data = array_map(fn (StatsData $stats): array => $stats->toArray(), $rawData);

        return $data;
    }
}
