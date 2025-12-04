<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\InquiryIndexData;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexInquiryResource;
use App\Models\Inquiry;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

final class InquiryController
{
    public function index(InquiryIndexData $data): Response
    {
        $inquiries = Inquiry::query()
            ->forIndexing($data)
            ->paginate(9, page: $data->page)
            ->withQueryString()
            ->through(function (Inquiry $inquiry): JsonResource {
                return $inquiry->toResource(IndexInquiryResource::class);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_INQUIRIES_INDEX->value, [
            'inquiries' => fn (): array => $inquiries,
        ]);
    }
}
