<?php

declare(strict_types=1);

it('works on properties page.', function (): void {
    $this->get(route('properties'))->assertOk();
});
