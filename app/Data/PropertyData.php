<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\PropertyAreaRangeEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyPriceRangeEnum;
use App\Enums\PropertyTypeEnum;
use Illuminate\Support\Collection;
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
        public ?PropertyPriceRangeEnum $price = null,
        public ?PropertyAreaRangeEnum $area = null,
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
            'price' => ['nullable', Rule::enum(PropertyPriceRangeEnum::class)],
            'area' => ['nullable', Rule::enum(PropertyAreaRangeEnum::class)],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }

    /*
     * Check if the field is not null.
     */
    public function isNotNull(string $field): bool
    {
        return ! is_null($this->$field);
    }

    /**
     * Get the price of the data.
     *
     * @return Collection<int, int<min, -1>|int<1, max>>|null
     */
    public function getPrice(): ?Collection
    {
        return $this->price?->collect();
    }

    /**
     * Get the area of the data.
     *
     * @return Collection<int, int<min, -1>|int<1, max>>|null
     */
    public function getArea(): ?Collection
    {
        return $this->area?->collect();
    }
}
