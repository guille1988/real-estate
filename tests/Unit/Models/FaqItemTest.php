<?php

declare(strict_types=1);

use App\Models\FaqItem;

it('contains all proper attributes.', function (): void {
    $faqItem = FaqItem::factory()
        ->create()
        ->fresh();

    expect(array_keys($faqItem->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'subtitle',
            'paragraphs',
            'faq_id',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(FaqItem::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(FaqItem::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('has a frequently asked question.', function (): void {
    expect(FaqItem::factory()->create()->faq)
        ->not->toBeNull();
});
