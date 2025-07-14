<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Number;

trait Priceable
{
    /*
     * Formats the price to dollar.
     */
    public function getDollarPrice(): string
    {
        /** @var string */
        return Number::currency(
            number: $this->price / 100,
            in: 'USD',
            precision: 2,
        );
    }
}
