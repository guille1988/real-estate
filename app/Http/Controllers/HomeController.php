<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\HomeData;
use App\Enums\PageEnum;
use App\Http\Resources\IndexPropertyResource;
use App\Models\Faq;
use App\Models\Property;
use App\Models\Testimonial;
use App\Support\AssetHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class HomeController
{
    /**
     * @throws Throwable
     */
    public function __invoke(HomeData $data): Response
    {
        $assets = cache()
            ->rememberForever('home_assets', function (): array {

                /**
                 * @var array<string, string> $assets
                 */
                $assets = app()->call(AssetHelper::class, [
                    'asset' => 'blue_building',
                ]);

                return $assets;
            });

        /**
         * @var array<string, mixed> $properties
         */
        $properties = cache()
            ->rememberForever($data->getCacheKey(), function () use ($data) {
                return Property::query()
                    ->featured()
                    ->paginate(20, page: $data->page)
                    ->through(function (Property $property): JsonResource {
                        return $property->toResource(IndexPropertyResource::class);
                    })->toArray();
            });

        $testimonials = cache()
            ->rememberForever('testimonials', function (): ResourceCollection {
                return Testimonial::query()
                    ->get([
                        'id',
                        'uuid',
                        'name',
                        'thumbnail',
                        'location',
                        'title',
                        'description',
                    ])->toResourceCollection();
            });

        $faq = cache()
            ->rememberForever('faq', function (): ResourceCollection {
                return Faq::query()
                    ->with('faqItems:id,uuid,subtitle,paragraphs,faq_id')
                    ->get([
                        'id',
                        'uuid',
                        'title',
                        'description',
                    ])->toResourceCollection();
            });

        return Inertia::render(PageEnum::HOME->value, [
            'assets' => fn (): array => $assets,
            'properties' => fn (): array => $properties,
            'page' => fn (): ?int => $data->page,
            'testimonials' => fn (): ResourceCollection => $testimonials,
            'faq' => fn (): ResourceCollection => $faq,
        ]);
    }
}
