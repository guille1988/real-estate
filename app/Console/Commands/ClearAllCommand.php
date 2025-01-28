<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class ClearAllCommand extends Command
{
    protected $signature = 'clear:all';

    protected $description = 'Clear the cache and the log file by executing the optimize:clear and the clear:log commands.';

    public function handle(): void
    {
        $this->call('optimize:clear');
        $this->call('clear:log');

        echo PHP_EOL;

        $this->components->info('Clear all command has been executed successfully.');
    }
}
