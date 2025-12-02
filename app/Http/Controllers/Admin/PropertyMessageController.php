<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\PropertyMessageBulkDestroyData;
use App\Data\Admin\PropertyMessageIndexData;
use App\Enums\PageEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Resources\Admin\IndexPropertyMessageResource;
use App\Models\PropertyMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

final class PropertyMessageController
{
    public function index(PropertyMessageIndexData $data): Response
    {
        $propertyMessages = PropertyMessage::query()
            ->forIndexing($data)
            ->paginate(9, page: $data->page)
            ->withQueryString()
            ->through(function (PropertyMessage $propertyMessage): JsonResource {
                return $propertyMessage->toResource(IndexPropertyMessageResource::class);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value, [
            'property_messages' => fn (): array => $propertyMessages,
            'property_types' => fn (): Collection => PropertyTypeEnum::toResponse(),
        ]);
    }

    public function bulkDestroy(PropertyMessageBulkDestroyData $data): RedirectResponse
    {
        PropertyMessage::query()
            ->whereIn('uuid', $data->uuids)
            ->delete();

        cache()->flush();

        return back();
    }

    public function destroy(PropertyMessage $propertyMessage): RedirectResponse
    {
        $propertyMessage->delete();
        cache()->flush();

        return back();
    }
}
