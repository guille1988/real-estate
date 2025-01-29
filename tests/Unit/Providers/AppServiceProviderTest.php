<?php

declare(strict_types=1);

it('has immutable dates.', function (): void {
    $tomorrow = ($now = now())
        ->addDay()
        ->toDateTimeString();

    $yesterday = $now->subDay()
        ->toDateTimeString();

    expect($tomorrow)->not->toEqual($yesterday);
});
