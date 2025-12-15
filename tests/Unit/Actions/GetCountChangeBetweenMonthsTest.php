<?php

declare(strict_types=1);

use App\Actions\GetCountChangeBetweenMonths;

it('devuelve 0% cuando ambos meses son 0', function (): void {

    $result = $this->app->make(GetCountChangeBetweenMonths::class)->execute(0, 0);

    expect($result)
        ->toBe('0%');
});

it('devuelve 100% cuando el mes pasado es 0 y el actual es mayor a 0', function (): void {
    $result = $this->app->make(GetCountChangeBetweenMonths::class)->execute(5, 0);

    expect($result)
        ->toBe('100%');
});

it('calcula el porcentaje correctamente cuando el mes pasado es > 0', function (): void {
    $result = $this->app->make(GetCountChangeBetweenMonths::class)->execute(15, 10);

    expect($result)->toBe('50%');
});
