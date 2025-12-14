<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\StatsData;
use App\Enums\ChangeTypeEnum;
use App\Models\ContactMessage;
use Illuminate\Support\Number;

final readonly class GetContactMessagesStats
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

        $contactMessagesCountOfLastMonth = ContactMessage::query()
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->count();

        $contactMessagesCountOfThisMonth = ContactMessage::query()
            ->whereBetween('created_at', [$startOfMonth, $now])
            ->count();

        $change = $this->getCountChangeBetweenMonths->execute(
            $contactMessagesCountOfThisMonth,
            $contactMessagesCountOfLastMonth,
        );

        $changeType = $contactMessagesCountOfThisMonth > $contactMessagesCountOfLastMonth
            ? ChangeTypeEnum::INCREASE
            : ChangeTypeEnum::DECREASE;

        /**
         * @var string $stat
         */
        $stat = Number::format($contactMessagesCountOfThisMonth);

        /**
         * @var string $previousStat
         */
        $previousStat = Number::format($contactMessagesCountOfLastMonth);

        return StatsData::from([
            'name' => 'Total Contact Messages From Last Month',
            'stat' => $stat,
            'previous_stat' => $previousStat,
            'change' => $change,
            'change_type' => $changeType,
        ]);
    }
}
