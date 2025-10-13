<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Enums\PaginationDirection;
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
        public ?int $page = null,
        public ?string $search = null,
        public ?int $bedrooms = null,
        public ?int $bathrooms = null,
        public ?PropertyTypeEnum $type = null,
        public ?PropertyLocationEnum $location = null,
        public ?string $sort = null,
        public ?PaginationDirection $direction = null,
        public ?bool $isFeatured = null,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'digits_between:1,100'],
            'search' => ['nullable', 'string', 'between:1,200'],
            'bedrooms' => ['nullable', 'integer', 'digits_between:1,20'],
            'bathrooms' => ['nullable', 'integer', 'digits_between:1,20'],
            'type' => ['nullable', Rule::enum(PropertyTypeEnum::class)],
            'location' => ['nullable', Rule::enum(PropertyLocationEnum::class)],
            'sort' => ['nullable', 'string', 'in:title,bathrooms,bedrooms,type,price'],
            'direction' => ['nullable', 'string', Rule::enum(PaginationDirection::class)],
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

    /*
     * Get the sort field.
     */
    public function getSort(): string
    {
        /**
         * @var string $sort
         */
        $sort = $this->isNotNull('sort')
            ? $this->sort
            : 'id';

        return $sort;
    }

    /*
     * Get the direction field.
     */
    public function getDirection(): string
    {
        /**
         * @var PaginationDirection $direction
         */
        $direction = $this->isNotNull('direction')
            ? $this->direction
            : PaginationDirection::ASC;

        return $direction->value;
    }
}
