<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Throwable;

final readonly class FormatTemporaryDirectory
{
    /**
     * @throws Throwable
     */
    public function execute(Property $property): void
    {

        $result = Artisan::call('format:images', [
            '--format' => config()->string('app.default_image_format'),
            '--path' => Storage::disk('tmp')->path($property->uuid),
        ]);

        throw_if($result !== 0, message: 'Image formatting failed.');
    }
}
