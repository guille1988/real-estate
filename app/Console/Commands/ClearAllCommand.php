<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class ClearAllCommand extends Command
{
    protected $signature = 'clear:all';

    protected $description = 'Clear the cache and the log file by executing the optimize:clear and the clear:log commands.';

    /*
     * Clear the log files.
     */
    private function clearLogs(): void
    {
        foreach (['laravel', 'browser'] as $log) {
            $this->call('clear:log', compact('log'));
        }
    }

    /*
     * Executes the clear:all command.
     */
    public function handle(): void
    {
        $this->call('optimize:clear');
        $this->clearLogs();

        $this->newLine();
        $this->components->info('Clear all command has been executed successfully.');
    }
}
