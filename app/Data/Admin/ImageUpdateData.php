<?php

declare(strict_types=1);

namespace App\Data\Admin;

use App\Models\Property;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class ImageUpdateData extends Data
{
    public function __construct(
        public string $property,
        public bool $isDefault,
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'property' => ['required', 'string', Rule::exists(Property::class, 'uuid')],
            'is_default' => ['required', 'boolean'],
        ];
    }
}
