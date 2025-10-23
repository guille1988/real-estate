<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\GetRangeOfMax;
use App\Data\Admin\PropertyIndexData;
use App\Data\Admin\PropertyStoreData;
use App\Enums\PageEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Resources\Admin\IndexPropertyResource;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class PropertyController
{
    /**
     * @throws Throwable
     */
    public function index(PropertyIndexData $data, GetRangeOfMax $action): Response
    {
        $properties = Property::query()
            ->forIndexing($data)
            ->paginate(7, page: $data->page)
            ->withQueryString()
            ->through(function (Property $property): JsonResource {
                return IndexPropertyResource::make($property);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_PROPERTIES_INDEX->value, [
            'properties' => fn (): array => $properties,
            'locations' => fn (): Collection => PropertyLocationEnum::toResponse(),
            'types' => fn (): Collection => PropertyTypeEnum::toResponse(),
            'bathrooms' => fn (): array => $action->execute('bathrooms'),
            'bedrooms' => fn (): array => $action->execute('bedrooms'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render(PageEnum::ADMIN_PROPERTIES_CREATE->value, [
            'locations' => fn (): Collection => PropertyLocationEnum::toResponse(),
            'types' => fn (): Collection => PropertyTypeEnum::toResponse(),
        ]);
    }

    public function edit(Property $property): Response
    {
        info('property:', $property->toArray());

        return Inertia::render(PageEnum::ADMIN_PROPERTIES_EDIT->value);
    }

    public function show(Property $property): Response
    {
        info('property:', $property->toArray());

        return Inertia::render(PageEnum::ADMIN_PROPERTIES_SHOW->value);
    }

    /**
     * @throws Throwable
     */
    public function store(PropertyStoreData $data): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $property = Property::create($data->toArray());

            /**
             * @var null|string $defaultImage
             */
            $defaultImage = null;

            foreach ($data->images as $image) {
                /**
                 * @var UploadedFile $file
                 */
                $file = $image['file'];
                $path = $file->store($property->uuid, 'tmp');

                if ($image['is_default']) {
                    $defaultImage = $path;
                }
            }

            info('Default image:', ['default_image' => $defaultImage]);

            // Logic of converting the images to JPEG and
            // attaching them to the property on a DB level.

            DB::commit();
        } catch (Throwable) {
            if (isset($property)) {
                Storage::disk('tmp')
                    ->deleteDirectory($property->uuid);
            }

            DB::rollBack();
        }

        return back();
    }

    public function update(Property $property): RedirectResponse
    {
        info('property:', $property->toArray());

        return back();
    }

    public function destroy(Property $property): RedirectResponse
    {
        info('property:', $property->toArray());

        return back();
    }
}
