<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\StatsData;
use App\Enums\ChangeTypeEnum;
use App\Models\Subscriber;
use Illuminate\Support\Number;

final readonly class GetSubscribersStats
{
    public function __construct(private GetCountChangeBetweenMonths $getCountChangeBetweenMonths) {}

    public function execute(): StatsData
    {
        $now = now()->toImmutable();

        $startOfMonth = $now->startOfMonth();

        $startOfLastMonth = $now->subMonth()
            ->startOfMonth();

        $endOfLastMonth = $now->subMonth()
            ->endOfMonth();

        $subscribersCountOfLastMonth = Subscriber::query()
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->count();

        $subscribersCountOfThisMonth = Subscriber::query()
            ->whereBetween('created_at', [$startOfMonth, $now])
            ->count();

        $change = $this->getCountChangeBetweenMonths->execute(
            $subscribersCountOfThisMonth,
            $subscribersCountOfLastMonth,
        );

        $changeType = $subscribersCountOfThisMonth > $subscribersCountOfLastMonth
            ? ChangeTypeEnum::INCREASE
            : ChangeTypeEnum::DECREASE;

        /**
         * @var string $stat
         */
        $stat = Number::format($subscribersCountOfThisMonth);

        /**
         * @var string $previousStat
         */
        $previousStat = Number::format($subscribersCountOfLastMonth);

        return StatsData::from([
            'name' => 'Total Subscribers',
            'stat' => $stat,
            'previous_stat' => $previousStat,
            'change' => $change,
            'change_type' => $changeType,
        ]);
    }
}
