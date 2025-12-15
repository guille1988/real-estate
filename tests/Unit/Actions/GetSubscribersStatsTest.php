<?php

declare(strict_types=1);

use App\Actions\GetSubscribersStats;
use App\Enums\ChangeTypeEnum;
use App\Models\Subscriber;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

uses(RefreshDatabase::class);

it('retorna incremento cuando este mes supera al anterior', function (): void {
    $now = CarbonImmutable::create(2025, 1, 15, 12);

    Carbon::setTestNow($now);

    $decDay = $now->subMonth()
        ->startOfMonth()
        ->addDays(10);

    Subscriber::factory()
        ->count($firstCount = 3)
        ->create([
            'created_at' => $decDay,
            'updated_at' => $decDay,
        ]);

    Subscriber::factory()
        ->count($secondCount = 5)
        ->create([
            'created_at' => $now->startOfMonth()->addDays(2),
            'updated_at' => $now->startOfMonth()->addDays(2),
        ]);

    $data = $this->app->make(GetSubscribersStats::class)->execute();

    expect($data->name)
        ->toBe('Total Subscribers From Last Month')
        ->and($data->stat)
        ->toBe(Number::format($secondCount))
        ->and($data->previousStat)
        ->toBe(Number::format($firstCount))
        ->and($data->changeType)
        ->toBe(ChangeTypeEnum::INCREASE)
        ->and($data->change)
        ->toBe(Number::percentage((($secondCount - $firstCount) / $firstCount) * 100));
});

it('retorna decremento cuando este mes es menor que el anterior', function (): void {
    $now = CarbonImmutable::create(2025, 2, 15, 12);

    Carbon::setTestNow($now);

    $janDay = $now->subMonth()
        ->startOfMonth()
        ->addDays(3);

    Subscriber::factory()
        ->count($firstCount = 6)
        ->create([
            'created_at' => $janDay,
            'updated_at' => $janDay,
        ]);

    Subscriber::factory()
        ->count($secondCount = 2)
        ->create([
            'created_at' => $now->startOfMonth()->addDays(7),
            'updated_at' => $now->startOfMonth()->addDays(7),
        ]);

    $data = $this->app->make(GetSubscribersStats::class)->execute();

    expect($data->name)
        ->toBe('Total Subscribers From Last Month')
        ->and($data->stat)
        ->toBe(Number::format($secondCount))
        ->and($data->previousStat)
        ->toBe(Number::format($firstCount))
        ->and($data->changeType)
        ->toBe(ChangeTypeEnum::DECREASE)
        ->and($data->change)
        ->toBe(Number::percentage((($secondCount - $firstCount) / $firstCount) * 100));
});
