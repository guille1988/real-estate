<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\ContactIndexData;
use App\Data\Admin\ContactMessageBulkDestroyData;
use App\Enums\ContactMessageInquiryTypeEnum;
use App\Enums\ContactMessageSourceEnum;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexContactMessageResource;
use App\Http\Resources\Admin\ShowContactMessageResource;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

final class ContactMessageController
{
    public function index(ContactIndexData $data): Response
    {
        $contactMessages = ContactMessage::query()
            ->forIndexing($data)
            ->paginate(9, page: $data->page)
            ->withQueryString()
            ->through(function (ContactMessage $contactMessage): JsonResource {
                return $contactMessage->toResource(IndexContactMessageResource::class);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value, [
            'contact_messages' => fn (): array => $contactMessages,
            'inquiry_types' => fn (): Collection => ContactMessageInquiryTypeEnum::toResponse(),
            'sources' => fn (): Collection => ContactMessageSourceEnum::toResponse(),
        ]);
    }

    public function show(ContactMessage $contactMessage): Response
    {
        if ($contactMessage->unread()) {
            $contactMessage = $contactMessage->markAsRead();

            cache()->flush();
        }

        return Inertia::render(PageEnum::ADMIN_CONTACT_MESSAGES_SHOW->value, [
            'contact_message' => fn (): JsonResource => $contactMessage->toResource(ShowContactMessageResource::class),
        ]);
    }

    public function bulkDestroy(ContactMessageBulkDestroyData $data): RedirectResponse
    {
        ContactMessage::query()
            ->whereIn('uuid', $data->uuids)
            ->delete();

        cache()->flush();

        return back();
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();
        cache()->flush();

        return back();
    }
}
