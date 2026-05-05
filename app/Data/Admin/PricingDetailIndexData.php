<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Enums\PaginationDirection;
use App\Enums\PricingDetailCategoryEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class PricingDetailIndexData extends Data
{
    public function __construct(
        public ?int $page = null,
        public ?string $search = null,
        public ?string $sort = null,
        public ?PaginationDirection $direction = null,
        public ?PricingDetailCategoryEnum $category = null,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'digits_between:1,100'],
            'search' => ['nullable', 'string', 'between:1,200'],
            'sort' => ['nullable', 'string', 'in:name,price,category'],
            'direction' => ['nullable', 'string', Rule::enum(PaginationDirection::class)],
            'category' => ['nullable', Rule::enum(PricingDetailCategoryEnum::class)],
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

    /**
     * Get the direction field.
     *
     * @return 'asc'|'desc'
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
