<?php

declare(strict_types=1);

namespace App\Support;

final class InertiaRequestHelper
{
    /**
     * Recursively transform array keys to snake case.
     *
     * @param  array<int|string, mixed>  $data
     * @return array<int|string, mixed>
     */
    public function __invoke(mixed $data): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            if (is_string($key)) {
                $key = str($key)
                    ->snake()
                    ->toString();
            }

            $result[$key] = is_array($value)
                ? $this($value)
                : $value;
        }

        return $result;
    }
}
