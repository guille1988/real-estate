<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

final class PropertyData extends Data
{
    public function __construct(
        public ?string $search,
    ) {}

    /**
     * @return array<string, array<int, string>>
     */
    public static function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'between:1,200'],
        ];
    }

    public function isNotEmpty(string $field): bool
    {
        return ! empty($this->$field);
    }
}
