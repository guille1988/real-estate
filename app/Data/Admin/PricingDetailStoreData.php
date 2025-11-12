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
final class PricingDetailStoreData extends Data
{
    public function __construct(
        public string $property,
        public PricingDetailCategoryEnum $category,
        /**
         * @var array<int, array{name: string, description: string, price: int}>
         */
        public array $pricingDetails,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'property' => ['required', 'string', Rule::exists(Property::class, 'uuid')],
            'category' => ['required', 'string', Rule::enum(PricingDetailCategoryEnum::class)],
            'pricing_details' => ['required', 'array', 'min:1'],
            'pricing_details.*.name' => ['required', 'string', 'between:2,200'],
            'pricing_details.*.description' => ['required', 'string', 'between:2,200'],
            'pricing_details.*.price' => ['required', 'integer', 'digits_between:1,1000000000'],
        ];
    }
}
