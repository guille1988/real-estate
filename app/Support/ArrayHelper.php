<?php

declare(strict_types=1);

namespace App\Support;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

final class ArrayHelper
{
    public static function transformKeysToCamelCase(mixed $raw): mixed
    {
        if (self::isNotArrayOrJsonSerializable($raw)) {
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
            $isClosure = false;

            if ($value instanceof Closure) {
                $isClosure = true;
                $value = $value();
            }

            if ($value instanceof JsonResource) {
                $value = $value->resolve();
            }

            if (self::isArrayOrJsonSerializable($value)) {
                $value = self::transformKeysToCamelCase($value);
            }

            if (is_string($key)) {
                $key = str($key)
                    ->camel()
                    ->toString();
            }

            $data[$key] = $isClosure
                ? fn () => $value
                : $value;
        }

        return $data;
    }

    public static function isNotArrayOrJsonSerializable(mixed $value): bool
    {
        return ! self::isArrayOrJsonSerializable($value);
    }

    public static function isArrayOrJsonSerializable(mixed $value): bool
    {
        return is_array($value) || $value instanceof JsonSerializable;
    }
}
