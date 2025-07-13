<?php

declare(strict_types=1);

it('works on contact page.', function (): void {
    $this->get(route('contact'))
        ->assertOk();
});
