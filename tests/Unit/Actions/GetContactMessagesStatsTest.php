<?php

declare(strict_types=1);

use App\Actions\GetContactMessagesStats;
use App\Enums\ChangeTypeEnum;
use App\Models\ContactMessage;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

uses(RefreshDatabase::class);

it('retorna incremento cuando este mes supera al anterior (contact messages)', function (): void {
    $now = CarbonImmutable::create(2025, 1, 20, 12);

    Carbon::setTestNow($now);

    $lastMonthDay = $now->subMonth()
        ->startOfMonth()
        ->addDays(8);

    ContactMessage::factory()
        ->count($firstCount = 2)
        ->createdOn($lastMonthDay)
        ->create();

    ContactMessage::factory()
        ->count($secondCount = 5)
        ->createdOn($now->startOfMonth()->addDays(5))
        ->create();

    $data = $this->app->make(GetContactMessagesStats::class)
        ->execute();

    expect($data->name)
        ->toBe('Total Contact Messages From Last Month')
        ->and($data->stat)
        ->toBe(Number::format($secondCount))
        ->and($data->previousStat)
        ->toBe(Number::format($firstCount))
        ->and($data->changeType)
        ->toBe(ChangeTypeEnum::INCREASE)
        ->and($data->change)
        ->toBe(Number::percentage((($secondCount - $firstCount) / $firstCount) * 100));
});

it('retorna decremento cuando este mes es menor que el anterior (contact messages)', function (): void {
    $now = CarbonImmutable::create(2025, 2, 10, 12);

    Carbon::setTestNow($now);

    $lastMonthDay = $now->subMonth()
        ->startOfMonth()
        ->addDays(10);

    ContactMessage::factory()
        ->count($firstCount = 6)
        ->createdOn($lastMonthDay)
        ->create();

    ContactMessage::factory()
        ->count($secondCount = 1)
        ->createdOn($now->startOfMonth()->addDays(3))
        ->create();

    $action = app(GetContactMessagesStats::class);
    $data = $action->execute();

    expect($data->name)
        ->toBe('Total Contact Messages From Last Month')
        ->and($data->stat)
        ->toBe(Number::format($secondCount))
        ->and($data->previousStat)
        ->toBe(Number::format($firstCount))
        ->and($data->changeType)
        ->toBe(ChangeTypeEnum::DECREASE)
        ->and($data->change)
        ->toBe(Number::percentage((($secondCount - $firstCount) / $firstCount) * 100));
});
