<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

final class PropertyData extends Data
{
    public function __construct(
        public ?string $search,
        public ?PropertyTypeEnum $type,
        public ?PropertyLocationEnum $location,
        public ?bool $isFeatured = null,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'between:1,200'],
            'type' => ['nullable', Rule::enum(PropertyTypeEnum::class)],
            'location' => ['nullable', Rule::enum(PropertyLocationEnum::class)],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }

    public function isNotEmpty(string $field): bool
    {
        return ! empty($this->$field);
    }
}
