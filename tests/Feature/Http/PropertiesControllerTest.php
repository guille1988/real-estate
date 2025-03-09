<?php

declare(strict_types=1);

it('works indexing properties.', function (): void {
    $this->get(route('properties.index'))->assertOk();
});

it('works showing a specific property.', function (): void {
    $this->get(route('properties.show', ['property' => 1]))->assertOk();
});
