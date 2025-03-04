<?php

declare(strict_types=1);

it('works on home page.', function (): void {
    $this->get(route('home'))->assertOk();
});
