<?php

declare(strict_types=1);

it('works on test endpoint successfully', function (): void {
    $this->getJson(route('test'))
        ->assertSuccessful();
});
