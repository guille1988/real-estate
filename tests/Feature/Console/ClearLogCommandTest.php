<?php

declare(strict_types=1);

use App\Console\Commands\ClearLogCommand;
use Illuminate\Support\Facades\File;

it("doesn't allow to set permitted logs from outside.", function (): void {
    app(ClearLogCommand::class)->permittedLogs = ['invalid'];
})->throws(BadMethodCallException::class);

it("fails to clear log if 'laravel.log' file doesn't exist.", function (string $log): void {
    $logFileName = "$log.log";

    File::shouldReceive('exists')
        ->once()
        ->with(storage_path("logs/$logFileName"))
        ->andReturn(false);

    $this->artisan('clear:log', compact('log'))
        ->expectsOutputToContain("The '$logFileName' file doesn't exist.")
        ->assertSuccessful();
})->with(fn (): array => app(ClearLogCommand::class)->permittedLogs);

it('fails to clear log if there is a problem with creating new file.', function (string $log): void {
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
})->with(fn (): array => app(ClearLogCommand::class)->permittedLogs);

it("doesn't clear invalid log.", function (string $log): void {
    $this->artisan('clear:log', compact('log'))
        ->expectsOutputToContain("The '$log' log is not permitted.")
        ->assertSuccessful();
})->with(['invalid_log_one', 'invalid_log_two']);

it('clears log successfully.', function (string $log): void {
    $this->artisan('clear:log', compact('log'))
        ->expectsOutputToContain("$log.log")
        ->assertSuccessful();
})->with(fn (): array => app(ClearLogCommand::class)->permittedLogs);
