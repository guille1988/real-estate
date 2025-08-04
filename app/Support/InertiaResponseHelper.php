<?php

declare(strict_types=1);

namespace App\Support;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

final class InertiaResponseHelper
{
    public function __invoke(mixed $raw): mixed
    {
        if ($this->isNotArrayOrJsonSerializable($raw)) {
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

            if ($this->isArrayOrJsonSerializable($value)) {
                $value = $this($value);
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

    private function isNotArrayOrJsonSerializable(mixed $value): bool
    {
        return ! $this->isArrayOrJsonSerializable($value);
    }

    private function isArrayOrJsonSerializable(mixed $value): bool
    {
        return is_array($value) || $value instanceof JsonSerializable;
    }
}
