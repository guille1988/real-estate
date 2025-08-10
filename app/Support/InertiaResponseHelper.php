<?php

declare(strict_types=1);

namespace App\Support;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

final class InertiaResponseHelper
{
    /**
     * Recursively transform array keys to camel case.
     */
    public function __invoke(mixed $data): mixed
    {
        if ($this->isNotArrayOrJsonSerializable($data)) {
            return $data;
        }

        $result = [];

        /**
         * @var array<int|string, mixed> $array
         */
        $array = $data instanceof Arrayable
            ? $data->toArray()
            : $data;

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

            $result[$key] = $isClosure
                ? fn () => $value
                : $value;
        }

        return $result;
    }

    /*
     * Checks if the data is not an array or implements JsonSerializable.
     */
    private function isNotArrayOrJsonSerializable(mixed $data): bool
    {
        return ! $this->isArrayOrJsonSerializable($data);
    }

    /*
     * Checks if the data is an array or implements JsonSerializable.
     */
    private function isArrayOrJsonSerializable(mixed $data): bool
    {
        return is_array($data) || $data instanceof JsonSerializable;
    }
}
