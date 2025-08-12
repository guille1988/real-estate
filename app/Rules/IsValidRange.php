<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Collection;

final class IsValidRange implements ValidationRule
{
    private string $error = 'Invalid range format.';

    /*
     * Checks if the range doesn't contain a dash.
     */
    private function doesntContainDash(string $range): bool
    {
        return ! $this->containsDash($range);
    }

    /*
     * Checks if the range contains a dash.
     */
    private function containsDash(string $range): bool
    {
        return str($range)->contains('-');
    }

    /**
     * @param  Collection<int, string>  $range
     *
     * Checks if the range is not valid.
     */
    private function isNotValid(Collection $range): bool
    {
        return ! $this->isValid($range);
    }

    /**
     * @param  Collection<int, string>  $range
     *
     * Checks if the range is valid.
     */
    private function isValid(Collection $range): bool
    {
        if ($range->count() !== 2) {
            return false;
        }

        if ($this->isAllNumeric($range)) {
            $newRange = $range->map(fn (string $value): int => (int) $value);

            return $newRange->first() < $newRange->last();
        }

        /**
         * @var string $min
         */
        $min = $range->first();

        /**
         * @var string $max
         */
        $max = $range->last();

        if ($this->isPlus($min)) {
            return is_numeric($max);
        }

        return false;

    }

    /**
     * @param  Collection<int, string>  $range
     *
     * Checks if all the values in the range are numeric.
     */
    private function isAllNumeric(Collection $range): bool
    {
        return $range->every(fn (string $value): bool => is_numeric($value));
    }

    /*
     * Checks if the value is plus.
     */
    private function isPlus(string $value): bool
    {
        return $value === 'plus';
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * @var string $value
         */
        if ($this->doesntContainDash($value)) {
            $fail($this->error);
        }

        $range = str($value)->explode('-');

        if ($this->isNotValid($range)) {
            $fail($this->error);
        }
    }
}
