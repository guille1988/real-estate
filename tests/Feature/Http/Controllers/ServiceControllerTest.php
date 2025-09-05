<?php

declare(strict_types=1);

it('works on services page.', function (): void {
    $this->get(route('services'))
        ->assertOk();
});
