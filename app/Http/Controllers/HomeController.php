<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\HomeData;
use App\Enums\PageEnum;
use App\Http\Resources\IndexPropertyResource;
use App\Models\Faq;
use App\Models\Property;
use App\Models\Testimonial;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;
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
        $properties = Property::query()
            ->featured()
            ->paginate(page: $data->page)
            ->through(function (Property $property): JsonResource {
                return IndexPropertyResource::make($property);
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
            'properties' => fn (): AbstractPaginator => $properties,
            'filters' => fn (): array => $data->toArray(),
            'testimonials' => fn (): ResourceCollection => $testimonials,
            'faq' => fn (): ResourceCollection => $faq,
        ]);
    }
}
