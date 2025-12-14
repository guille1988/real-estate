<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\StatsData;
use App\Enums\ChangeTypeEnum;

final readonly class GetStats
{
    public function __construct(
        private GetSubscribersStats $getSubscribersStats,
        private GetContactMessagesStats $getContactMessagesStats,
    ) {}

    /**
     * @return array<int, array<string, string|ChangeTypeEnum>>
     */
    public function execute(): array
    {
        /**
         * @var array<int, StatsData> $rawData
         */
        $rawData = [
            $this->getSubscribersStats->execute(),
            $this->getContactMessagesStats->execute(),
            $this->getSubscribersStats->execute(),
        ];

        /**
         * @var array<int, array<string, string|ChangeTypeEnum>> $data
         */
        $data = array_map(fn (StatsData $stats): array => $stats->toArray(), $rawData);

        return $data;
    }
}
