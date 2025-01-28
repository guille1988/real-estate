<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

it("fails to clear log if 'laravel.log' file doesn't exist", function (): void {
    File::shouldReceive('exists')
        ->once()
        ->with(storage_path('logs/laravel.log'))
        ->andReturn(false);

    $this->artisan('clear:log')
        ->expectsOutputToContain("The 'laravel.log' file doesn't exist.")
        ->assertSuccessful();
});

it('fails to clear log if there is a problem with creating new file', function (): void {
    File::shouldReceive('exists')
        ->once()
        ->with($logFilePath = storage_path('logs/laravel.log'))
        ->andReturn(true);

    File::shouldReceive('put')
        ->once()
        ->with($logFilePath, '')
        ->andReturn(false);

    $this->artisan('clear:log')
        ->expectsOutputToContain('Something went wrong and the log file was not cleared.')
        ->assertSuccessful();
});

it('clears log successfully', function (): void {
    $this->artisan('clear:log')
        ->expectsOutputToContain('log')
        ->assertSuccessful();
});
