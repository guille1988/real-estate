<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\BulkDestroyImages;
use App\Data\Admin\ImageBulkDestroyData;
use App\Data\Admin\ImageData;
use App\Data\Admin\ImageStoreData;
use App\Enums\ImageFormatEnum;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexImageResource;
use App\Http\Resources\Admin\SelectPropertyResource;
use App\Models\Image;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\Laravel\Facades\Image as ImageFacade;
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
                return $image->toResource(IndexImageResource::class);
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
            return Property::all(['uuid', 'title'])
                ->toResourceCollection(SelectPropertyResource::class);
        });

        return Inertia::render(PageEnum::ADMIN_IMAGES_CREATE->value, [
            'properties' => fn (): ResourceCollection => $properties,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(ImageStoreData $data): RedirectResponse
    {
        try {
            DB::beginTransaction();

            /**
             * @var Property $property
             */
            $property = Property::firstWhere('uuid', $data->property);

            if ($data->containsDefaultImage()) {
                $property->images()
                    ->update(['is_default' => false]);
            }

            /**
             * @var array<int, array{file: UploadedFile, is_default: bool}> $image
             */
            foreach ($data->images as $image) {
                Storage::disk('images')
                    ->makeDirectory($property->getFolderPathForNewImages());

                $completePath = Storage::disk('images')
                    ->path($path = $property->getFilePathForNewImages());

                ImageFormatEnum::from(config()->string('app.default_image_format'))
                    ->getEncodeMethod(ImageFacade::read($image['file']->getPathname()))
                    ->save($completePath);

                $property->images()
                    ->create([
                        'path' => $path,
                        'is_default' => $image['is_default'],
                    ]);
            }

            DB::commit();

        } catch (Throwable $exception) {
            DB::rollBack();

            if (isset($property)) {
                Storage::disk('images')
                    ->deleteDirectory($property->getFolderPathForNewImages());
            }

            throw $exception;
        }

        cache()->flush();

        return back();
    }

    public function bulkDestroy(ImageBulkDestroyData $data, BulkDestroyImages $action): RedirectResponse
    {
        $action->execute($data);

        cache()->flush();

        return back();
    }

    public function destroy(Image $image): RedirectResponse
    {
        $image->deleteCompletely();

        cache()->flush();

        return back();
    }
}
