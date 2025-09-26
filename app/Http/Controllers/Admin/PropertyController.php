<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexPropertyResource;
use App\Models\Property;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class PropertyController
{
    /**
     * @throws Throwable
     */
    public function index(): Response
    {
        $properties = Property::query()
            ->forIndexing()
            ->get()
            ->toResourceCollection(IndexPropertyResource::class);

        return Inertia::render(PageEnum::ADMIN_PROPERTIES->value, [
            'properties' => fn (): ResourceCollection => $properties,
        ]);
    }
}
