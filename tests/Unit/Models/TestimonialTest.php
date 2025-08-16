<?php

declare(strict_types=1);

use App\Models\Testimonial;

it('contains all proper attributes.', function (): void {
    $testimonial = Testimonial::factory()
        ->create()
        ->fresh();

    expect(array_keys($testimonial->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'name',
            'thumbnail',
            'location',
            'title',
            'description',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Testimonial::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Testimonial::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('gets thumbnail URL as expected.', function (): void {
    expect(Testimonial::factory()->create()->getUrl())
        ->toBeUrl();
});
