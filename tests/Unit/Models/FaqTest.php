<?php

declare(strict_types=1);

use App\Models\Faq;
use App\Models\FaqItem;

it('contains all proper attributes.', function (): void {
    $faq = Faq::factory()
        ->create()
        ->fresh();

    expect(array_keys($faq->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'title',
            'description',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Faq::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Faq::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('has faq items.', function (): void {
    $faq = Faq::factory()
        ->create();

    FaqItem::factory($count = 4)
        ->create(['faq_id' => $faq->id]);

    expect($faq->fresh()->faqItems)
        ->toHaveCount($count);
});
