<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\PropertyMessageIndexData;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexPropertyMessageResource;
use App\Models\PropertyMessage;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

final class PropertyMessageController
{
    public function index(PropertyMessageIndexData $data): Response
    {
        $propertyMessages = PropertyMessage::query()
            ->forIndexing($data)
            ->paginate(7, page: $data->page)
            ->withQueryString()
            ->through(function (PropertyMessage $propertyMessage): JsonResource {
                return $propertyMessage->toResource(IndexPropertyMessageResource::class);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value, [
            'property_messages' => fn (): array => $propertyMessages,
        ]);
    }
}
