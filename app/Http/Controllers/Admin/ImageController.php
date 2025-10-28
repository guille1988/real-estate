<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\ImageData;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexImageResource;
use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

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
}
