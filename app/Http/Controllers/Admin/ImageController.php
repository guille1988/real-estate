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
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use SplFileInfo;
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
        DB::beginTransaction();

        try {
            /**
             * @var Property $property
             */
            $property = Property::firstWhere('uuid', $data->property);
            $defaultImage = '';

            foreach ($data->images as $image) {
                /**
                 * @var UploadedFile $file
                 */
                $file = $image['file'];

                /**
                 * @var string $path
                 */
                $path = $file->store($property->uuid, 'tmp');

                if ($image['is_default']) {
                    $defaultImage = $path;
                }
            }

            $fullDestinationPath = Storage::disk('images')
                ->path($destinationPath = $property->getDestinationPath());

            File::copyDirectory(
                Storage::disk('tmp')->path($property->uuid),
                $fullDestinationPath,
            );

            Storage::disk('tmp')
                ->deleteDirectory($property->uuid);

            if (File::isEmptyDirectory(Storage::disk('tmp')->path(''))) {
                Storage::disk('tmp')->deleteDirectory('');
            }

            $images = collect(File::allFiles($fullDestinationPath))
                ->map(function (SplFileInfo $file) use ($destinationPath, $defaultImage): array {
                    $name = $file->getFilename();

                    return [
                        'path' => "$destinationPath/$name",
                        'is_default' => str($defaultImage)->contains($name),
                    ];
                });

            $property->images()->createMany($images);

            cache()->flush();

            DB::commit();
        } catch (Throwable $exception) {
            if (isset($property)) {
                collect(['images', 'tmp'])
                    ->each(function (string $disk) use ($property): void {
                        Storage::disk($disk)->deleteDirectory($property->uuid);
                    });
            }

            DB::rollBack();

            throw $exception;
        }

        return back();
    }
}
