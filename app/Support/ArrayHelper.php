<?php

declare(strict_types=1);

namespace App\Support;

final class ArrayHelper
{
    /**
     * @param  array<int|string, mixed>  $rawData
     * @return array<int|string, mixed>
     */
    public static function transformKeysToCamelCase(array $rawData): array
    {
        /**
         * @var array<int|string, mixed> $data
         */
        $data = [];

        foreach ($rawData as $key => $value) {
            if (is_array($value)) {
                $value = self::transformKeysToCamelCase($value);
            }

            if (is_string($key)) {
                $key = str($key)->camel()->toString();
            }

            $data[$key] = $value;
        }

        return $data;
    }
}
