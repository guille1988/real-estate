<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class DestroyProperty
{
    public function __construct(private DestroyImagesOfProperty $action) {}

    /**
     * @throws Throwable
     */
    public function execute(Property $property): void
    {
        DB::transaction(function () use ($property): void {
            $this->action->execute($property);
            $property->amenities()->delete();
            $property->pricingDetails()->delete();
            $property->delete();
        });
    }
}
