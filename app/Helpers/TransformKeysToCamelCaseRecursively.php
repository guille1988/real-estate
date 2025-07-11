<?php

declare(strict_types=1);

// @codeCoverageIgnoreStart
if (! function_exists('transformKeysToCamelCaseRecursively')) {
    // @codeCoverageIgnoreEnd

    /**
     * @param  array<int|string, mixed>  $rawData
     * @return array<int|string, mixed>
     */
    function transformKeysToCamelCaseRecursively(array $rawData): array
    {
        /**
         * @var array<int|string, mixed> $data
         */
        $data = [];

        foreach ($rawData as $key => $value) {
            if (is_array($value)) {
                $value = transformKeysToCamelCaseRecursively($value);
            }

            if (is_string($key)) {
                $key = str($key)->camel()->toString();
            }

            $data[$key] = $value;
        }

        return $data;
    }
}
