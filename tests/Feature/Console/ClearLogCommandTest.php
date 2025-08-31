<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

it("fails to clear log if 'laravel.log' file doesn't exist", function (string $log): void {
    $logFileName = "$log.log";

    File::shouldReceive('exists')
        ->once()
        ->with(storage_path("logs/$logFileName"))
        ->andReturn(false);

    $this->artisan('clear:log', compact('log'))
        ->expectsOutputToContain("The '$logFileName' file doesn't exist.")
        ->assertSuccessful();
})->with(['laravel', 'browser']);

it('fails to clear log if there is a problem with creating new file', function (string $log): void {
    $logFileName = "$log.log";

    File::shouldReceive('exists')
        ->once()
        ->with($logFilePath = storage_path("logs/$logFileName"))
        ->andReturn(true);

    File::shouldReceive('put')
        ->once()
        ->with($logFilePath, '')
        ->andReturn(false);

    $this->artisan('clear:log', compact('log'))
        ->expectsOutputToContain("Something went wrong and the '$logFileName' file was not cleared.")
        ->assertSuccessful();
})->with(['laravel', 'browser']);

it("doesn't clear invalid log", function (string $log): void {
    $this->artisan('clear:log', compact('log'))
        ->expectsOutputToContain("The '$log' log is not permitted.")
        ->assertSuccessful();
})->with(['invalid_log_one', 'invalid_log_two']);

it('clears log successfully', function (string $log): void {
    $this->artisan('clear:log', compact('log'))
        ->expectsOutputToContain("$log.log")
        ->assertSuccessful();
})->with(['laravel', 'browser']);
