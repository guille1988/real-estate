<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

final class ClearLogCommand extends Command
{
    protected $signature = 'clear:log';

    protected $description = 'Clear the project log file.';

    private readonly string $logFilePath;

    public function __construct()
    {
        parent::__construct();
        $this->logFilePath = storage_path('logs/laravel.log');
    }

    public function handle(): void
    {
        File::exists($this->logFilePath) ?
            $this->createNewEmptyLogFile() :
            $this->components->error("The 'laravel.log' file doesn't exist.");
    }

    private function createNewEmptyLogFile(): void
    {
        is_int(File::put($this->logFilePath, '')) ?
            $this->components->task('log') :
            $this->components->error('Something went wrong and the log file was not cleared.');
    }
}
