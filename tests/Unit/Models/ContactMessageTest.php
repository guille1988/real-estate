<?php

declare(strict_types=1);

use App\Models\ContactMessage;

it('contains all proper attributes.', function (): void {
    $contactMessage = ContactMessage::factory()
        ->create()
        ->fresh();

    expect(array_keys($contactMessage->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'first_name',
            'last_name',
            'email',
            'phone',
            'inquiry_type',
            'source',
            'message',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(ContactMessage::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(ContactMessage::factory()->create()->uniqueIds())
        ->toContain('uuid');
});
