<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use App\Http\Resources\IndexPropertyResource;
use App\Models\Property;
use App\Models\Testimonial;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class HomeController
{
    /**
     * @throws Throwable
     */
    public function __invoke(): Response
    {
        $featuredProperties = cache()
            ->rememberForever('featured_properties', function (): ResourceCollection {
                return Property::query()
                    ->with('defaultImage:id,path,property_id')
                    ->featured()
                    ->get([
                        'id',
                        'uuid',
                        'caption',
                        'title',
                        'description',
                        'type',
                        'bathrooms',
                        'bedrooms',
                        'price',
                    ])->toResourceCollection(IndexPropertyResource::class);
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

        return Inertia::render(PageEnum::HOME->value, [
            'featured_properties' => fn (): ResourceCollection => $featuredProperties,
            'testimonials' => fn (): ResourceCollection => $testimonials,
        ]);
    }
}
