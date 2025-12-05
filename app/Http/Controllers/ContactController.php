<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\ContactMessageData;
use App\Enums\ContactMessageInquiryTypeEnum;
use App\Enums\ContactMessageSourceEnum;
use App\Enums\PageEnum;
use App\Models\ContactMessage;
use App\Models\OfficeLocation;
use App\Support\AssetHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class ContactController
{
    /**
     * @throws Throwable
     */
    public function index(): Response
    {
        $assets = cache()
            ->rememberForever('contact_assets', function (): array {

                /**
                 * @var array<string, string> $assets
                 */
                $assets = app()->call(AssetHelper::class, [
                    'asset' => [
                        'office',
                        'team',
                        'working_team',
                        'team_man_portrait',
                        'team_woman_portrait',
                        'handshake',
                    ],
                ]);

                return $assets;
            });

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
            'assets' => fn (): array => $assets,
            'office_locations' => fn (): ResourceCollection => $officeLocations,
            'inquiry_types' => fn (): Collection => ContactMessageInquiryTypeEnum::toResponse(),
            'sources' => fn (): Collection => ContactMessageSourceEnum::toResponse(),
        ]);
    }

    public function store(ContactMessageData $data): RedirectResponse
    {
        ContactMessage::create($data->toArray());

        return back();
    }
}
