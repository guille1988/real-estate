<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\ImageData;
use App\Data\Admin\ImageStoreData;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexImageResource;
use App\Http\Resources\Admin\SelectPropertyResource;
use App\Models\Image;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class ImageController
{
    public function index(ImageData $data): Response
    {
        $images = Image::query()
            ->forIndexing($data)
            ->paginate(7, page: $data->page)
            ->withQueryString()
            ->through(function (Image $image): JsonResource {
                return IndexImageResource::make($image);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_IMAGES_INDEX->value, [
            'images' => fn (): array => $images,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function create(): Response
    {
        $properties = cache()->rememberForever('admin_property_select', function (): ResourceCollection {
            return Property::query()
                ->forSelecting()
                ->get(['uuid', 'title'])
                ->toResourceCollection(SelectPropertyResource::class);
        });

        return Inertia::render(PageEnum::ADMIN_IMAGES_CREATE->value, [
            'properties' => fn (): ResourceCollection => $properties,
        ]);
    }

    public function store(ImageStoreData $data): RedirectResponse
    {
        info($data->property);

        return back();
    }
}
