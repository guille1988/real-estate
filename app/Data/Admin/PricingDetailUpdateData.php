<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Enums\PricingDetailCategoryEnum;
use App\Models\Property;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class PricingDetailUpdateData extends Data
{
    public function __construct(
        public string $property,
        public string $name,
        public PricingDetailCategoryEnum $category,
        public int $price,
        public string $description,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'property' => ['required', 'string', 'between:2,100', Rule::exists(Property::class, 'uuid')],
            'name' => ['required', 'string', 'between:2,200'],
            'category' => ['required', 'string', Rule::enum(PricingDetailCategoryEnum::class)],
            'price' => ['required', 'integer', 'between:1,100000000'],
            'description' => ['required', 'string', 'between:2,200'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        /**
         * @var array<string, mixed> $data
         */
        $data = parent::toArray();
        unset($data['property']);

        return $data;
    }
}
