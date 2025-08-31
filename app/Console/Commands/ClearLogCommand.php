<?php

declare(strict_types=1);

namespace App\Console\Commands;

use BadMethodCallException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

final class ClearLogCommand extends Command
{
    protected $signature = 'clear:log {log}';

    protected $description = 'Clear a project specific log file.';

    /**
     * @var string[]
     */
    public array $permittedLogs = ['laravel', 'browser'] {
        get => $this->permittedLogs;
        set => throw new BadMethodCallException(
            'The permitted logs cannot be changed from outside.',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        );
    }

    /**
     * Gets the log file name and path.
     *
     * @return array<int,string>
     */
    private function getLogData(): array
    {
        $this->validateLog($log = $this->argument('log'));

        return [
            $logFileName = "$log.log",
            storage_path("logs/$logFileName"),
        ];
    }

    /*
     * Validates the log file name.
     */
    private function validateLog(string $log): void
    {
        if ($this->isNotPermittedLog($log)) {
            $this->components->error("The '$log' log is not permitted.");
        }
    }

    /*
     * Checks if the log is permitted.
     */
    private function isNotPermittedLog(string $log): bool
    {
        return ! in_array($log, $this->permittedLogs);
    }

    /*
     * Handles the log clearing.
     */
    private function handleLogClearing(string $logFilePath, string $logFileName): void
    {
        $result = File::put($logFilePath, '');

        $this->isLogCleared($result)
            ? $this->components->task($logFileName)
            : $this->components->error("Something went wrong and the '$logFileName' file was not cleared.");
    }

    /*
     * Checks if the log file is cleared.
     */
    private function isLogCleared(bool|int $result): bool
    {
        return is_int($result);
    }

    /*
     * Executes the clear:log command.
     */
    public function handle(): void
    {
        [$logFileName, $logFilePath] = $this->getLogData();

        File::exists($logFilePath)
            ? $this->handleLogClearing($logFilePath, $logFileName)
            : $this->components->error("The '$logFileName' file doesn't exist.");
    }
}
