<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\File;

final class AtLeastOneDefaultImage implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * @var array<int, array{file: string, is_default: bool}> $value
         */
        if (array_all($value, fn (array $image): bool => ! $image['is_default'])) {
            $fail('At least one image must be a default one.');
        }
    }
}
