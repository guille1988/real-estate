<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\PropertyBudgetEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class PropertyMessageData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        #[WithCast(EnumCast::class)]
        public PropertyLocationEnum $location,
        #[WithCast(EnumCast::class)]
        public PropertyTypeEnum $propertyType,
        #[WithCast(EnumCast::class)]
        public PropertyBudgetEnum $budget,
        public int $bedrooms,
        public int $bathrooms,
        public ?string $message,
        public bool $termsAgreed,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'between:2,200'],
            'last_name' => ['required', 'string', 'between:2,200'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'between:8,20'],
            'location' => ['required', Rule::enum(PropertyLocationEnum::class)],
            'property_type' => ['required', Rule::enum(PropertyTypeEnum::class)],
            'budget' => ['required', 'string', Rule::enum(PropertyBudgetEnum::class)],
            'bedrooms' => ['required', 'integer', 'digits_between:1,8'],
            'bathrooms' => ['required', 'integer', 'digits_between:1,8'],
            'message' => ['nullable', 'string', 'between:2,2000'],
            'terms_agreed' => ['accepted'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();

        unset($data['terms_agreed']);

        return $data;
    }
}
