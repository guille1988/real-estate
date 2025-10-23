<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

final class OnlyOneDefaultImage implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * @var array<int, array{file: UploadedFile, is_default: bool}> $value
         */
        $defaultImagesCount = collect($value)
            ->filter(fn (array $image): bool => $image['is_default'])
            ->count();

        if ($defaultImagesCount !== 1) {
            $fail('You must have only one default image as mandatory.');
        }
    }
}
