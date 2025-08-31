<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use App\Models\OfficeLocation;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class ContactController
{
    /**
     * @throws Throwable
     */
    public function __invoke(): Response
    {
        $officeLocations = cache()
            ->rememberForever('office_locations', function (): ResourceCollection {
                return OfficeLocation::query()
                    ->get([
                        'uuid',
                        'type',
                        'email',
                        'title',
                        'address',
                        'description',
                        'phone',
                        'location',
                        'url',
                    ])->toResourceCollection();
            });

        return Inertia::render(PageEnum::CONTACT->value, [
            'office_locations' => fn (): ResourceCollection => $officeLocations,
        ]);
    }
}
