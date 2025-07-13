<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Contracts\Support\Arrayable;

final class ArrayHelper
{
    public static function transformKeysToCamelCase(mixed $raw): mixed
    {
        if (self::isNotArrayOrArrayable($raw)) {
            return $raw;
        }

        $data = [];

        /**
         * @var array<int|string, mixed> $array
         */
        $array = $raw instanceof Arrayable
            ? $raw->toArray()
            : $raw;

        foreach ($array as $key => $value) {
            if (self::isArrayOrArrayable($value)) {
                $value = self::transformKeysToCamelCase($value);
            }

            if (is_string($key)) {
                $key = str($key)->camel()->toString();
            }

            $data[$key] = $value;
        }

        return $data;
    }

    public static function isArrayOrArrayable(mixed $value): bool
    {
        return is_array($value) || $value instanceof Arrayable;
    }

    public static function isNotArrayOrArrayable(mixed $value): bool
    {
        return ! self::isArrayOrArrayable($value);
    }
}
