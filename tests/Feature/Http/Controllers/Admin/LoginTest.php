<?php

declare(strict_types=1);

it('works on login page.', function (): void {
    $this->get(route('admin.login'))
        ->assertOk();
});
