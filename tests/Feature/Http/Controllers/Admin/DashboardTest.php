<?php

declare(strict_types=1);

it('works on dashboard page.', function (): void {
    $this->get(route('admin.dashboard'))
        ->assertOk();
});
