<?php

declare(strict_types=1);

use App\Actions\GetCountChangeBetweenMonths;

it('returns 0 percent when both months are 0.', function (): void {

    $result = $this->app->make(GetCountChangeBetweenMonths::class)->execute(0, 0);

    expect($result)
        ->toBe('0%');
});

it('returns 100 percent when last month is 0 and the current is greater than 0.', function (): void {
    $result = $this->app->make(GetCountChangeBetweenMonths::class)->execute(5, 0);

    expect($result)
        ->toBe('100%');
});

it('calculates the percentage correctly when last month is greater than 0.', function (): void {
    $result = $this->app->make(GetCountChangeBetweenMonths::class)->execute(15, 10);

    expect($result)->toBe('50%');
});
