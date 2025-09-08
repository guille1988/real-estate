<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Throwable;

/** @codeCoverageIgnore */
final class FormatSeederImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'format:seeder-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command formats seeder images to the desired format.';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(): void
    {
        $this->call('format:images', [
            '--format' => config('app.default_image_format'),
            '--path' => storage_path('app/private/seeders/images'),
        ]);
    }
}
