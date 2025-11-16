<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Models\Property;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class AmenityStoreData extends Data
{
    public function __construct(
        public string $property,
        /**
         * @var array<int, array{description: string}>
         */
        public array $amenities,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'property' => ['required', 'string', Rule::exists(Property::class, 'uuid')],
            'amenities' => ['required', 'array', 'min:1'],
            'amenities.*.description' => ['required', 'string', 'between:2,200'],
        ];
    }
}
