<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Rules\IsValidRange;
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
        public ?string $price = null,
        public ?string $area = null,
        public ?bool $isFeatured = null,
    ) {}

    /**
     * Get the field of the data.
     *
     * @return Collection<int, int<min, -1>|int<1, max>>
     */
    private function getField(string $field): Collection
    {
        /**
         * @var string $dataField
         */
        $dataField = $this->$field;

        return str($dataField)
            ->explode('-')
            ->map(function (string $value): ?int {
                return is_numeric($value)
                    ? (int) $value
                    : null;
            })
            ->values()
            ->filter();
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'between:1,200'],
            'location' => ['nullable', Rule::enum(PropertyLocationEnum::class)],
            'type' => ['nullable', Rule::enum(PropertyTypeEnum::class)],
            'price' => ['nullable', 'string', 'between:12,14', new IsValidRange],
            'area' => ['nullable', 'string', 'between:8,9', new IsValidRange],
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
     * @return Collection<int, int<min, -1>|int<1, max>>
     */
    public function getPrice(): Collection
    {
        return $this->getField('price');
    }

    /**
     * Get the area of the data.
     *
     * @return Collection<int, int<min, -1>|int<1, max>>
     */
    public function getArea(): Collection
    {
        return $this->getField('area');
    }
}
