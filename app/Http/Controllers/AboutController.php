<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use App\Models\Team;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class AboutController
{
    /**
     * @throws Throwable
     */
    public function __invoke(): Response
    {
        $team = cache()
            ->rememberForever('team', function (): ResourceCollection {
                return Team::query()
                    ->get([
                        'id',
                        'uuid',
                        'name',
                        'position',
                        'thumbnail',
                    ])->toResourceCollection();
            });

        return Inertia::render(PageEnum::ABOUT->value, compact('team'));
    }
}
