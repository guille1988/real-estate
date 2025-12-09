<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\SubscriberBulkDestroyData;
use App\Data\Admin\SubscriberIndexData;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexSubscriberResource;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

final class SubscriberController
{
    public function index(SubscriberIndexData $data): Response
    {
        $subscriber = Subscriber::query()
            ->forIndexing($data)
            ->paginate(10, page: $data->page)
            ->withQueryString()
            ->through(function (Subscriber $subscriber): JsonResource {
                return $subscriber->toResource(IndexSubscriberResource::class);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value, [
            'subscribers' => fn (): array => $subscriber,
        ]);
    }

    public function bulkDestroy(SubscriberBulkDestroyData $data): RedirectResponse
    {
        Subscriber::query()
            ->whereIn('uuid', $data->uuids)
            ->delete();

        cache()->flush();

        return back();
    }

    public function destroy(Subscriber $subscriber): RedirectResponse
    {
        $subscriber->delete();
        cache()->flush();

        return back();
    }
}
