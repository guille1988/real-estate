<?php

declare(strict_types=1);

it('clears all successfully', function (): void {
    $this->artisan('clear:all')
        ->expectsOutputToContain('Clear all command has been executed successfully.')
        ->assertSuccessful();
});
