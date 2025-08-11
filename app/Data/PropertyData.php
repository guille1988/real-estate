<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class PropertyData extends Data
{
    public function __construct(
        public ?string $search = null,
        public ?PropertyLocationEnum $location = null,
        public ?PropertyTypeEnum $type = null,
        public ?array $price = null,
        public ?array $area = null,
        public ?bool $isFeatured = null,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'between:1,200'],
            'location' => ['nullable', Rule::enum(PropertyLocationEnum::class)],
            'type' => ['nullable', Rule::enum(PropertyTypeEnum::class)],
            'price' => ['nullable', 'array', 'min:1', 'max:2'],
            'price.0' => ['required_with:price', 'integer', 'lt:price.1'],
            'price.1' => ['nullable', 'integer', 'gt:price.0'],
            'area' => ['nullable', 'array', 'min:1', 'max:2'],
            'area.0' => ['required_with:area', 'integer', 'lt:area.1'],
            'area.1' => ['nullable', 'integer', 'gt:area.0'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }

    public function isNotNull(string $field): bool
    {
        return ! is_null($this->$field);
    }
}
