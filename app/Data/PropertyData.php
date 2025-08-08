<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\PropertyTypeEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

final class PropertyData extends Data
{
    public function __construct(
        public ?string $search,
        public ?PropertyTypeEnum $type,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'between:1,200'],
            'type' => ['nullable', Rule::enum(PropertyTypeEnum::class)],
        ];
    }

    public function isNotEmpty(string $field): bool
    {
        return ! empty($this->$field);
    }
}
