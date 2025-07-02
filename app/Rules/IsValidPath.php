<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class IsValidPath implements ValidationRule
{
    /*
     * Checks if the path is not valid
     */
    private function isNotValidPath(string $path): bool
    {
        return ! $this->isValidPath($path);
    }

    /*
     * Checks if the path is valid
     */
    private function isValidPath(string $path): bool
    {
        return str($path)->contains(base_path());
    }

    /*
     * Validates if the given path is valid
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * @var string $value
         */
        if ($this->isNotValidPath($value)) {
            $fail("The $attribute must be a path inside the project's directory.");
        }
    }
}
