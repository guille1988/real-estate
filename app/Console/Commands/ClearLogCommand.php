<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

final class ClearLogCommand extends Command
{
    /**
     * @var string[]
     */
    private array $permittedLogs = ['laravel', 'browser'];

    protected $signature = 'clear:log {log}';

    protected $description = 'Clear a project specific log file.';

    /*
     * Executes the clear:log command.
     */
    public function handle(): void
    {
        $log = $this->argument('log');

        if (! in_array($log, $this->permittedLogs)) {
            $this->components->error("The '$log' log is not permitted.");
        }

        $logFileName = "$log.log";
        $logFilePath = storage_path("logs/$logFileName");

        if (File::exists($logFilePath)) {
            $wasLogFileCreated = File::put($logFilePath, '');

            if (is_int($wasLogFileCreated)) {
                $this->components->task($logFileName);
            } else {
                $this->components->error("Something went wrong and the '$logFileName' file was not cleared.");
            }
        } else {
            $this->components->error("The '$logFileName' file doesn't exist.");
        }
    }
}
